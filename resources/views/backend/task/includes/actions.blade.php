<div class="btn-group" role="group" aria-label="@lang('labels.backend.task.task_actions')">
    <a href="{{ route('admin.task.show', $task) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
        <i class="fas fa-eye"></i>
    </a>

    @if($task->task_type !== 'repeated')
    <a href="{{ route('admin.task.edit', $task) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    @endif
</div>
