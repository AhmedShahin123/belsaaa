@extends('backend.layouts.app')

@section('title', __('labels.backend.notification.management') . ' | ' . __('labels.backend.notification.view'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.notification.management')
                        <small class="text-muted">@lang('labels.backend.notification.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.task.tabs.titles.overview')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>@lang('labels.backend.notification.tabs.content.overview.id')</th>
                                            <td>{{ $notification->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.backend.notification.tabs.content.overview.notifiable_type')</th>
                                            <td>{{ $notification->notifiable_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.backend.notification.tabs.content.overview.notifiable_id')</th>
                                            <td>{{ $notification->notifiable_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.backend.notification.tabs.content.overview.data')</th>
                                            <td>{{ is_array($notification->data) ? json_encode($notification->data) : $notification->data }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('labels.backend.task.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($notification->created_at) }} ({{ $notification->created_at->diffForHumans() }}),
                        <strong>@lang('labels.backend.task.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($notification->updated_at) }} ({{ $notification->updated_at->diffForHumans() }})
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

