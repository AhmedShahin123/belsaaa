<div class="col">
    @if($task->latitude && $task->longitude)
    <task-location :point="{latitude: {{$task->latitude}}, longitude:{{$task->longitude}}}"></task-location>
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.task.tabs.content.overview.title')</th>
                <td>{{ $task->title }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.overview.description')</th>
                <td>{{ $task->description }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.overview.task_type')</th>
                <td>{{ \Str::studly($task->task_type) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.overview.status')</th>
                <td>{{ \Str::studly($task->status) }}</td>
            </tr>

            <tr>
                <th>{{ __('validation.attributes.backend.task.required_tasker_gender') }}</th>
                <td>{{ __('validation.attributes.backend.task.required_tasker_gender_'.$task->required_tasker_gender) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.overview.employer')</th>
                <td>@include('backend.includes.user_link', ['user' => $task->employer])</td>
            </tr>

            @include('backend.task.show.tabs.overview.'.$task->task_type.'_attributes')
        </table>
    </div>
</div><!--table-responsive-->

