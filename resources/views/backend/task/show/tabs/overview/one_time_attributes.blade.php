<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.one_time_attributes.start_date')</th>
    <td>{{ $task->task_attributes->start_date->format('Y-m-d') }}</td>
</tr>

<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.one_time_attributes.start_time')</th>
    <td>{{ Carbon\Carbon::createFromTimeString($task->task_attributes->start_time)->setTimezone('Asia/Riyadh')->format('H:i') }}</td>
</tr>

<tr>
    <th>@lang('labels.backend.task.tabs.content.overview.one_time_attributes.end_time')</th>
    <td>{{ Carbon\Carbon::createFromTimeString($task->task_attributes->end_time)->setTimezone('Asia/Riyadh')->format('H:i') }}</td>
</tr>
