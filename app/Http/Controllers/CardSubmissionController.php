<?php

namespace App\Http\Controllers;

use App\Mail\GuestSubmittedMail;
use App\Models\Card;
use App\Models\CardSubmission;
use App\Models\CardSubmissionValue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CardSubmissionController extends Controller
{
    public function store(Request $request, string $token): RedirectResponse
    {
        $card = Card::where('share_token', $token)->with('fields', 'user')->firstOrFail();

        // Build validation rules dynamically from card fields
        $rules = [];
        foreach ($card->fields as $field) {
            $rule = $field->required ? 'required' : 'nullable';
            if ($field->type === 'email') $rule .= '|email';
            if ($field->type === 'number') $rule .= '|numeric';
            $rules["field_{$field->id}"] = $rule;
        }
        $request->validate($rules);

        $submission = CardSubmission::create([
            'card_id'      => $card->id,
            'submitter_ip' => $request->ip(),
        ]);

        foreach ($card->fields as $field) {
            $value = $request->input("field_{$field->id}");
            if (is_array($value)) $value = implode(', ', $value);

            CardSubmissionValue::create([
                'submission_id' => $submission->id,
                'field_id'      => $field->id,
                'value'         => $value,
            ]);
        }

        // Email notification to card owner (requires mail config in .env)
        try {
            if ($card->user && $card->user->email) {
                Mail::to($card->user->email)->send(new GuestSubmittedMail($card, $submission));
            }
        } catch (\Exception $e) {
            // Silently fail if mail not configured
        }

        return back()->with('submit_success', 'Your response has been submitted. Thank you!');
    }

    public function index(Card $card): View
    {
        $card->load(['fields', 'submissions.values.field']);
        return view('cards.responses', compact('card'));
    }

    public function export(Card $card)
    {
        $card->load(['fields', 'submissions.values.field']);

        $headers = ['Submission #', 'Submitted At'];
        foreach ($card->fields as $field) {
            $headers[] = $field->label;
        }

        $rows = [];
        foreach ($card->submissions as $submission) {
            $row = [$submission->id, $submission->created_at->format('Y-m-d H:i:s')];
            $valueMap = $submission->values->keyBy('field_id');
            foreach ($card->fields as $field) {
                $row[] = $valueMap->get($field->id)?->value ?? '';
            }
            $rows[] = $row;
        }

        $filename = 'responses-' . $card->id . '-' . now()->format('Ymd') . '.csv';

        $callback = function () use ($headers, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
