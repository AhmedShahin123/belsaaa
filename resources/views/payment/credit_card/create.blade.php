@extends('frontend.layouts.app')


@section('content')
    <div class="container" style="direction: rtl; text-align: right">
        <div class="row">
            <div class="col-xs-12">
                @if($error)
                    {{$error}}
                @else
                    تم حفظ بطاقة الائتمان الخاصة بك في ملف التعريف الخاص بك.
                @endif
            </div>
        </div>
        <div class="row">
            @if ($error)
                <div class="col-xs-12">
                    <a id="card-error" data-error="{{$error}}" class="btn btn-warning" href="belsaa://credit_card/card_error">العودة إلى التطبيق</a>
                </div>
            @else
                <div class="col-xs-12">
                    <a id="card-link" data-card-id="{{$card->id}}" class="btn btn-primary" href="belsaa://credit_card/{{$card->id}}">العودة إلى التطبيق</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@push('after-scripts')
    <script !src="">
        $(function () {
            window.addEventListener('message', function(event) { console.log(event); })
            $('#card-link').click(function (e) {
                var cardId = $('#card-link').data('cardId');
                console.log(cardId);
                const eventData = {event: 'card_added', data: {card_id: cardId}};
                if (window.ReactNativeWebView !== undefined && window.ReactNativeWebView.postMessage !== undefined) {
                    window.ReactNativeWebView.postMessage(JSON.stringify(eventData));
                }

                if (window.postMessage !== undefined) {
                    window.postMessage(JSON.stringify(eventData));
                }
                e.preventDefault();
                return false;
            })
            $('#card-error').click(function (e) {
                var error = $('#card-error').data('error');
                const eventData = {event: 'card_errir', data: {error: error}};
                if (window.ReactNativeWebView !== undefined && window.ReactNativeWebView.postMessage !== undefined) {
                    window.ReactNativeWebView.postMessage(JSON.stringify(eventData));
                }

                if (window.postMessage !== undefined) {
                    window.postMessage(JSON.stringify(eventData));
                }
                e.preventDefault();
                return false;
            })

        })
    </script>
@endpush
