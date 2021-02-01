<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.task.tabs.content.task_attributes.start_at')</th>
                <td>{{ $task->task_attributes->start_at }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.task_attributes.daily_duration')</th>
                <td>{{ $task->task_attributes->daily_duration }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.task_attributes.end_date')</th>
                <td>{{ $task->task_attributes->end_date }}</td>
            </tr>
        </table>
    </div>
</div>

