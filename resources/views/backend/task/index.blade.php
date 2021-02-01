@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.task.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.task.management') }}
                    </h4>
                </div><!--col-->


                <div class="col-sm-7">
                    <div class="btn-group float-right" role="group">
                        <button id="create-task-button" type="button" class="btn btn-success dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            {{ __('strings.backend.task.create_new_task') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="create-task-button">
                            <a class="dropdown-item" href="{{route('admin.task.create', ['task_type' => 'one_time'])}}">{{ __('strings.backend.task.task_type.one_time') }}</a>
                            <a class="dropdown-item" href="{{route('admin.task.create', ['task_type' => 'continued'])}}">{{ __('strings.backend.task.task_type.continued') }}</a>
                            <a class="dropdown-item" href="{{route('admin.task.create', ['task_type' => 'repeated'])}}">{{ __('strings.backend.task.task_type.repeated') }}</a>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    {{ html()->form('GET')->class('form-inline')->open() }}

                        <div class="form-group mx-sm-3 mb-2">
                            {{html()->text('filters[title]', request()->query('filters')['title'] ?? '')->class('form-control')->placeholder(__('strings.backend.task.title'))}}
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            {{html()
                                ->select('filters[type]')
                                ->class('form-control')
                                ->options(['' => '--- '.__('strings.backend.task._task_type').' ---', 'one_time' => __('strings.backend.task.task_type.one_time'), 'continued' => __('strings.backend.task.task_type.continued'), 'repeated' => __('strings.backend.task.task_type.repeated')])
                                ->value(request()->query('filters')['type'] ?? '')
                            }}
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="filter-sent-to-admin">{{__('strings.backend.task.sent_to_admin')}}</label>
                            {{html()
                                ->checkbox('filters[sentToAdmin]')
                                ->id('filter-sent-to-admin')
                                ->class('form-control')
                                ->value(true)
                                ->checked(request()->query('filters')['sentToAdmin'] ?? false)
                            }}
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            {{html()->select('filters[status]')->class('form-control')->options([
                                '' => '--- '.__('strings.backend.task._status').' ---',
                                'initiate' => __('strings.backend.task.status.initiate'),
                                'selected_by_tasker' => __('strings.backend.task.status.selected_by_tasker'),
                                'sending' => __('strings.backend.task.status.sending'),
                                'accepted' => __('strings.backend.task.status.accepted'),
                                'rejected' => __('strings.backend.task.status.rejected'),
                                'started' => __('strings.backend.task.status.started'),
                                'finished' => __('strings.backend.task.status.finished'),
                                'canceled' => __('strings.backend.task.status.canceled'),
                                'expired' => __('strings.backend.task.status.expired'),
                            ])->value(request()->query('filters')['status'] ?? '')}}
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">{{__('strings.backend.task.filter')}}</button>
                    {{html()->closeModelForm()}}

                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.task.table.title')</th>
                                <th>@lang('labels.backend.task.table.description')</th>
                                <th>@lang('labels.backend.task.table.task_type')</th>
                                <th>@lang('labels.backend.task.table.status')</th>
                                <th>@lang('labels.backend.task.table.employer')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ \Str::studly($task->task_type) }}</td>
                                    <td>{{ \Str::studly($task->status) }}</td>
                                    <td>@include('backend.includes.user_link', ['user' => $task->employer])</td>
{{--                                    <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>--}}
{{--                                    <td>{{ $user->roles_label }}</td>--}}
{{--                                    <td>{{ $user->permissions_label }}</td>--}}
{{--                                    <td>@include('backend.auth.user.includes.social-buttons', ['user' => $user])</td>--}}
{{--                                    <td>{{ $user->updated_at->diffForHumans() }}</td>--}}
                                    <td class="btn-td">@include('backend.task.includes.actions', ['task' => $task])</td>
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
                        {!! $tasks->total() !!} {{ trans_choice('labels.backend.task.table.total', $tasks->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $tasks->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
