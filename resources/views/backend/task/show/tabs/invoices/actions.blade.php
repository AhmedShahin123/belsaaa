@if(!$invoice->commission_paid)
<div class="btn-group" role="group" aria-label="@lang('labels.backend.task.task_actions')">
    <a href="#" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info commission-paid" data-invoice-id="{{$invoice->id}}">
        <i class="fas fa-eye"></i>
    </a>
</div>
@endif
@if(!$invoice->tasker_amount_cleared)
<div class="btn-group" role="group" aria-label="@lang('labels.backend.task.task_actions')">
    <a href="#" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.clear')" class="btn btn-info tasker-amount-cleared" data-invoice-id="{{$invoice->id}}">
        <i class="fas fa-eye"></i>
    </a>
</div>
@endif


@push('after-scripts')
    <script !src="">
        $(function () {
            $('.tasker-amount-cleared').click(function (event) {
                Swal.fire({
                    title: 'Are you sure you want to clear tasker amount for this issue?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Tasker amount is cleared!'
                }).then((result) => {
                    if (result.value) {
                        const onSuccess = function(response) {
                            Swal.fire(
                                'Cleared!',
                                'Tasker amount has been cleared. ',
                                'success'
                            ).then(function (result) {
                                window.location.reload()
                            })
                        }

                        $.ajax({
                            'url': '/invoice/'+$(event.target).closest('a').data('invoiceId')+'/clear_tasker_amount',
                            'method': 'PUT',
                            'headers': {
                                'Accept': 'application/json',
                            }
                        }).then(onSuccess);
                    }
                })
                event.preventDefault();
                return false;
            })
        })
    </script>
@endpush
