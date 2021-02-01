<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.continued_attributes.start_at')</th>
    <td>{{ $task->task_attributes->start_at->setTimezone('Asia/Riyadh') }}</td>
</tr>

<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.continued_attributes.daily_duration')</th>
    <td>{{ $task->task_attributes->daily_duration }}</td>
</tr>

<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.continued_attributes.end_date')</th>
    <td>{{ $task->task_attributes->end_date->setTimezone('Asia/Riyadh') }}</td>
</tr>
