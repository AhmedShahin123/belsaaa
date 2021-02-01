@extends('frontend.layouts.app')


@section('content')
    <div class="container" style="direction: rtl; text-align: right">
        <div class="row">
            <div class="col-xs-12">
                @if($payment->status === 'paid')
                    تم دفع دفعتك.
                @else
                    كانت هناك مشكلة في الدفع.
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a id="payment-link" data-task-id="{{$invoices[0]->task_id}}" class="btn btn-primary" href="belsaa://task/{{$invoices[0]->task_id}}">العودة إلى التطبيق</a>
            </div>
        </div>
    </div>
@endsection

@section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@push('after-scripts')
    <script !src="">
        $(function () {
            $('#payment-link').click(function (e) {
                var taskId = $('#payment-link').data('taskId');
                console.log(taskId);
                const paid = {{$payment->status === 'paid' ? 'true' : 'false'}};
                const eventData = {event: 'payment_result', data: {task_id: taskId, paid: paid}};
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
