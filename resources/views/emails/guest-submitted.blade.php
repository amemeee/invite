<x-mail::message>
# New Response Received

Someone just submitted a response to your invite card **{{ $card->title }}**.

**Submitted:** {{ $submission->created_at->format('d M Y, H:i') }}

<x-mail::table>
| Field | Answer |
|:------|:-------|
@foreach($submission->values as $value)
| {{ $value->field->label }} | {{ $value->value ?? '—' }} |
@endforeach
</x-mail::table>

<x-mail::button :url="route('cards.responses', $card)">
View All Responses
</x-mail::button>

Thanks,
{{ config('app.name') }}
</x-mail::message>
