<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
{{--{{ Illuminate\Mail\Markdown::parse($slot) }}--}}
    @isset($actionText)
        @slot('subcopy')
            @lang(
                "SI you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                'into your web browser:',
                [
                    'actionText' => $slot->actionText,
                ]
            ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        @endslot
    @else
        @php
           $arr = explode('browser: ', Illuminate\Mail\Markdown::parse($slot))
        @endphp
        @lang(
            "Si tienes problemas para abrir el enlace, haz click aquí: \":actionText\" ",
            [
                'actionText' => $arr[1]
            ]
            )
    @endisset
</td>
</tr>
</table>

{{-- Subcopy --}}


{{--@isset($actionText)--}}
{{--    @slot('subcopy')--}}
{{--        @lang(--}}
{{--            "SI you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
{{--            'into your web browser:',--}}
{{--            [--}}
{{--                'actionText' => $actionText,--}}
{{--            ]--}}
{{--        ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>--}}
{{--    @endslot--}}
{{--@endisset--}}
