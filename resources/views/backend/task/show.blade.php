@extends('backend.layouts.app')

@section('title', __('labels.backend.task.management') . ' | ' . __('labels.backend.task.view'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.task.management')
                        <small class="text-muted">@lang('labels.backend.task.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i>
                                {{ __('labels.backend.task.tabs.titles.overview') }}</a>
                        </li>
                        @if($task->task_type !== 'repeated')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assignment_requests" role="tab" aria-controls="assignment_requests" aria-expanded="true"><i class="fas fa-users"></i>
                                {{ __('labels.backend.task.tabs.titles.assignment_requests') }}</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#attributes" role="tab" aria-controls="attributes" aria-expanded="true"><i class="fas fa-users"></i>
                                {{ __('labels.backend.task.tabs.titles.attributes') }}</a>
                        </li>
                        @if($task->task_type !== 'repeated')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assigned_taskers" role="tab" aria-controls="assigned_taskers" aria-expanded="true"><i class="fas fa-users"></i>
                                {{ __('labels.backend.task.tabs.titles.assigned_taskers') }}</a>
                        </li>
                        @endif
                        @if($task->task_type === 'repeated')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#children_tasks" role="tab" aria-controls="children_tasks" aria-expanded="true"><i class="fas fa-users"></i>
                                    {{ __('labels.backend.task.tabs.titles.children_tasks') }}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-expanded="true"><i class="fas fa-users"></i>
                                {{ __('labels.backend.task.tabs.titles.invoices') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.task.show.tabs.overview')
                        </div><!--tab-->
                        @if($task->task_type !== 'repeated')
                        <div class="tab-pane" id="assignment_requests" role="tabpanel" aria-expanded="true">
                            @include('backend.task.show.tabs.assignment_requests')
                        </div><!--tab-->
                        @endif
                        <div class="tab-pane" id="attributes" role="tabpanel" aria-expanded="true">
                            @include('backend.task.show.tabs.attributes')
                        </div><!--tab-->
                        @if($task->task_type !== 'repeated')
                        <div class="tab-pane" id="assigned_taskers" role="tabpanel" aria-expanded="true">
                            @include('backend.task.show.tabs.assigned_taskers')
                        </div><!--tab-->
                        @endif
                        @if($task->task_type === 'repeated')
                            <div class="tab-pane" id="children_tasks" role="tabpanel" aria-expanded="true">
                                @include('backend.task.show.tabs.children_tasks')
                            </div><!--tab-->
                        @endif
                        <div class="tab-pane" id="invoices" role="tabpanel" aria-expanded="true">
                            @include('backend.task.show.tabs.invoices')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('labels.backend.task.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($task->created_at) }} ({{ $task->created_at->diffForHumans() }}),
                        <strong>@lang('labels.backend.task.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($task->updated_at) }} ({{ $task->updated_at->diffForHumans() }})
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

