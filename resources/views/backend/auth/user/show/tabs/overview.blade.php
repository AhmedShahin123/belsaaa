<div class="col">
    @if($user->latitude && $user->longitude)
        <task-location :point="{latitude: {{$user->latitude}}, longitude:{{$user->longitude}}}"></task-location>
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
{{--            <tr>--}}
{{--                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>--}}
{{--                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>--}}
{{--            </tr>--}}

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.access.users.tabs.content.overview.email') }}</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.cellphone')</th>
                <td>{{ $user->cellphone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>@include('backend.auth.user.includes.status', ['user' => $user])</td>
            </tr>

{{--            <tr>--}}
{{--                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>--}}
{{--                <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>--}}
{{--            </tr>--}}

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ timezone()->convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr>

            @if($user->user_type === 'tasker')
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.total_earned')</th>
                    <td>{{ $user->totalEarned() }} SAR</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.finished_task_count')</th>
                    <td>{{ $user->finishedTaskCount() }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.average_rate')</th>
                    <td>{{ $user->average_rating }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.not_cleared_tasker_amount')</th>
                    <td>
                        {{ $user->notClearedTaskerAmount() }}
                        SAR
                        @if($user->notClearedTaskerAmount() > 0)
                            <a href="#"
                               data-toggle="tooltip"
                               data-placement="top"
                               class="btn btn-info clear-tasker-amount"
                               data-last-invoice-id="{{$user->tasker_invoices_not_cleared->last()->id}}"
                               data-amount="{{$user->notClearedTaskerAmount()}}"
                               data-user-id="{{$user->id}}"
                            >
                                Clear tasker amount
                            </a>
                        @endif
                    </td>
                </tr>
            @endif

            @if($user->user_type === 'employer')
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.total_paid')</th>
                    <td>{{ $user->totalPaid() }} SAR</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.total_must_pay')</th>
                    <td>{{ $user->totalMustPay() }} SAR</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.not_paid_commission')</th>
                    <td>{{ $user->employer_commission_not_paid_invoices->sum('commission') }}
                        SAR
                        @if($user->employer_commission_not_paid_invoices->sum('commission') > 0)
                            <a href="#"
                               data-toggle="tooltip"
                               data-placement="top"
                               class="btn btn-info clear-commission"
                               data-last-invoice-id="{{$user->employer_commission_not_paid_invoices->last()->id}}"
                               data-amount="{{$user->employer_commission_not_paid_invoices->sum('commission')}}"
                               data-user-id="{{$user->id}}"
                            >
                                Clear
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.finished_task_count')</th>
                    <td>{{ $user->finishedTaskCount() }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.finished_task_count')</th>
                    <td>{{ $user->finishedTaskCount() }}</td>
                </tr>
            @endif
        </table>
    </div>
</div><!--table-responsive-->


@push('after-scripts')
    <script !src="">
        $(function () {
            $('.clear-commission').click(function (event) {
                Swal.fire({
                    title: 'Are you sure you want to clear commissions of this employer?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Commissions is paid!'
                }).then((result) => {
                    if (result.value) {
                        const onSuccess = function(response) {
                            Swal.fire(
                                'Cleared!',
                                'Commissions have been cleared. ',
                                'success'
                            ).then(function (result) {
                                window.location.reload()
                            })
                        }

                        $.ajax({
                            'url': '/invoice/'+$(event.target).closest('a').data('userId')+'/pay_employer_commissions',
                            'method': 'PUT',
                            'data': {
                                'before_invoice_id': $(event.target).closest('a').data('lastInvoiceId'),
                                'amount': $(event.target).closest('a').data('amount'),
                            },
                            'headers': {
                                'Accept': 'application/json',
                            }
                        })
                        .then(onSuccess)
                        .catch(function () {
                            window.location.reload();
                        });
                    }
                })
                event.preventDefault();
                return false;
            })

            $('.clear-tasker-amount').click(function (event) {
                Swal.fire({
                    title: 'Are you sure you want to clear tasker amount?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, tasker amount is cleared!'
                }).then((result) => {
                    if (result.value) {
                        const onSuccess = function(response) {
                            Swal.fire(
                                'Cleared!',
                                'Tasker amount have been cleared. ',
                                'success'
                            ).then(function (result) {
                                window.location.reload()
                            })
                        }

                        $.ajax({
                            'url': '/invoice/'+$(event.target).closest('a').data('userId')+'/clear_tasker_amounts',
                            'method': 'PUT',
                            'data': {
                                'before_invoice_id': $(event.target).closest('a').data('lastInvoiceId'),
                                'amount': $(event.target).closest('a').data('amount'),
                            },
                            'headers': {
                                'Accept': 'application/json',
                            }
                        })
                        .then(onSuccess)
                        .catch(function () {
                            window.location.reload();
                        });
                    }
                })
                event.preventDefault();
                return false;
            })
        })
    </script>
@endpush
