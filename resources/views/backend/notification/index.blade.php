@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.notification.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.notification.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.notification.table.notifiable_type')</th>
                                <th>@lang('labels.backend.notification.table.notifiable_id')</th>
                                <th>@lang('labels.backend.notification.table.data')</th>
                                <th>@lang('labels.backend.notification.table.sent_at')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->notifiable_type }}</td>
                                    <td>{{ $notification->notifiable_id }}</td>
                                    <td>{{ is_array($notification->data) ? json_encode($notification->data) : $notification->data }}</td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td class="btn-td">@include('backend.notification.includes.actions', ['notification' => $notification])</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $notifications->total() !!} {{ trans_choice('labels.backend.notification.table.total', $notifications->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $notifications->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
