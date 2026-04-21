<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CardFieldController extends Controller
{
    public function store(Request $request, Card $card): RedirectResponse
    {
        $request->validate([
            'label'   => 'required|max:100',
            'type'    => 'required|in:text,textarea,email,phone,number,select,radio,checkbox',
            'options' => 'nullable|string',
            'required' => 'nullable|boolean',
        ]);

        $options = null;
        if (in_array($request->type, ['select', 'radio', 'checkbox']) && $request->options) {
            $options = array_values(array_filter(array_map('trim', explode("\n", $request->options))));
        }

        $order = $card->fields()->max('order') ?? 0;

        CardField::create([
            'card_id'  => $card->id,
            'label'    => $request->label,
            'type'     => $request->type,
            'options'  => $options,
            'required' => $request->boolean('required'),
            'order'    => $order + 1,
        ]);

        return back()->with('success', 'Field added!');
    }

    public function destroy(Card $card, CardField $field): RedirectResponse
    {
        $field->delete();
        return back()->with('success', 'Field removed.');
    }

    public function moveUp(Card $card, CardField $field): RedirectResponse
    {
        $prev = $card->fields()->where('order', '<', $field->order)->orderByDesc('order')->first();
        if ($prev) {
            [$field->order, $prev->order] = [$prev->order, $field->order];
            $field->save();
            $prev->save();
        }
        return back();
    }

    public function moveDown(Card $card, CardField $field): RedirectResponse
    {
        $next = $card->fields()->where('order', '>', $field->order)->orderBy('order')->first();
        if ($next) {
            [$field->order, $next->order] = [$next->order, $field->order];
            $field->save();
            $next->save();
        }
        return back();
    }
}
