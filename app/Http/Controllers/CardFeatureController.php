<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardCountdown;
use App\Models\CardGallery;
use App\Models\CardLocation;
use App\Models\CardMusic;
use App\Models\CardRsvp;
use App\Models\CardWish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CardFeatureController extends Controller
{
    public function manage(Card $card): View
    {
        $card->load(['countdown', 'location', 'music', 'galleries', 'rsvps', 'wishes']);
        return view('cards.manage', compact('card'));
    }

    // ── COUNTDOWN ──
    public function storeCountdown(Request $request, Card $card): RedirectResponse
    {
        $request->validate(['label' => 'required', 'event_date' => 'required|date']);

        $card->countdown()->updateOrCreate(
            ['card_id' => $card->id],
            ['label' => $request->label, 'event_date' => $request->event_date]
        );

        return back()->with('success', 'Countdown saved!');
    }

    public function destroyCountdown(Card $card): RedirectResponse
    {
        $card->countdown()->delete();
        return back()->with('success', 'Countdown removed.');
    }

    // ── LOCATION ──
    public function storeLocation(Request $request, Card $card): RedirectResponse
    {
        $request->validate(['address' => 'required']);

        $card->location()->updateOrCreate(
            ['card_id' => $card->id],
            ['venue_name' => $request->venue_name, 'address' => $request->address, 'embed_url' => $request->embed_url]
        );

        return back()->with('success', 'Location saved!');
    }

    public function destroyLocation(Card $card): RedirectResponse
    {
        $card->location()->delete();
        return back()->with('success', 'Location removed.');
    }

    // ── MUSIC ──
    public function storeMusic(Request $request, Card $card): RedirectResponse
    {
        $request->validate(['source_type' => 'required|in:file,url']);

        if ($request->source_type === 'file') {
            $request->validate(['source_file' => 'required|file|mimes:mp3,ogg,wav|max:10240']);
            $old = $card->music;
            if ($old && $old->source_type === 'file') {
                Storage::disk('public')->delete($old->source_value);
            }
            $path = $request->file('source_file')->store('music', 'public');
            $sourceValue = $path;
        } else {
            $request->validate(['source_url' => 'required|url']);
            $sourceValue = $request->source_url;
        }

        $card->music()->updateOrCreate(
            ['card_id' => $card->id],
            ['title' => $request->title, 'source_type' => $request->source_type, 'source_value' => $sourceValue, 'autoplay' => $request->boolean('autoplay')]
        );

        return back()->with('success', 'Music saved!');
    }

    public function destroyMusic(Card $card): RedirectResponse
    {
        $music = $card->music;
        if ($music) {
            if ($music->source_type === 'file') {
                Storage::disk('public')->delete($music->source_value);
            }
            $music->delete();
        }
        return back()->with('success', 'Music removed.');
    }

    // ── GALLERY ──
    public function storeGallery(Request $request, Card $card): RedirectResponse
    {
        $request->validate(['images' => 'required|array', 'images.*' => 'image|max:4096']);

        $order = $card->galleries()->max('order') ?? 0;
        foreach ($request->file('images') as $image) {
            $path = $image->store("galleries/{$card->id}", 'public');
            CardGallery::create(['card_id' => $card->id, 'image_path' => $path, 'caption' => null, 'order' => ++$order]);
        }

        return back()->with('success', 'Photos uploaded!');
    }

    public function destroyGallery(Card $card, CardGallery $photo): RedirectResponse
    {
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();
        return back()->with('success', 'Photo removed.');
    }

    // ── RSVP (public) ──
    public function storeRsvp(Request $request, string $token): RedirectResponse
    {
        $card = Card::where('share_token', $token)->firstOrFail();
        $request->validate(['guest_name' => 'required|max:100', 'guest_email' => 'nullable|email', 'status' => 'required|in:attending,not_attending,maybe', 'note' => 'nullable|max:300']);

        CardRsvp::create(['card_id' => $card->id, 'guest_name' => $request->guest_name, 'guest_email' => $request->guest_email, 'status' => $request->status, 'note' => $request->note]);

        return back()->with('rsvp_success', 'Thank you! Your RSVP has been received.');
    }

    // ── WISHES (public) ──
    public function storeWish(Request $request, string $token): RedirectResponse
    {
        $card = Card::where('share_token', $token)->firstOrFail();
        $request->validate(['guest_name' => 'required|max:100', 'message' => 'required|max:500']);

        CardWish::create(['card_id' => $card->id, 'guest_name' => $request->guest_name, 'message' => $request->message]);

        return back()->with('wish_success', 'Your wish has been sent!');
    }
}
