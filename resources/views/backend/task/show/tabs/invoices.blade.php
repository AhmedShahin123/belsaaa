<table class="table">
    <thead>
    <tr>
        <th>{{ __('labels.backend.task.tabs.content.invoices.tasker') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.employer_amount') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.tasker_amount') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.commission') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.tasker_amount_paid') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.commission_paid') }}</th>
        <th>{{ __('labels.backend.task.tabs.content.invoices.tasker_amount_cleared') }}</th>
        <th>{{ __('labels.general.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($task->invoices as $invoice)
        <tr>
            <td>@include('backend.includes.user_link', ['user' => $invoice->tasker])</td>
            <td>{{ $invoice->employer_amount }}</td>
            <td>{{ $invoice->tasker_amount }}</td>
            <td>{{ $invoice->commission }}</td>
            <td>
                @include('backend.includes.show_status', ['value' => $invoice->tasker_amount_paid])
            </td>
            <td>
                @include('backend.includes.show_status', ['value' => $invoice->commission_paid])
            </td>
            <td>
                @include('backend.includes.show_status', ['value' => $invoice->tasker_amount_cleared])
            </td>
            <td class="btn-td">@include('backend.task.show.tabs.invoices.actions', ['task' => $task])</td>
        </tr>
    @endforeach
    </tbody>
</table>

@push('after-scripts')
    <script !src="">
        $(function () {
            $('.commission-paid').click(function (event) {
                Swal.fire({
                    title: 'Are you sure you want to make this invoice as commission paid?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Commission is paid!'
                }).then((result) => {
                    if (result.value) {
                        const onSuccess = function(response) {
                            Swal.fire(
                                'Paid!',
                                'Commission has been paid. ',
                                'success'
                            ).then(function (result) {
                                window.location.reload()
                            })
                        }

                        $.ajax({
                            'url': '/invoice/'+$(event.target).closest('a').data('invoiceId')+'/pay_commission',
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
