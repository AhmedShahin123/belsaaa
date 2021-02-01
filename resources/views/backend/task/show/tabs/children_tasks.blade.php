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
    @foreach($task->children as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->task_type }}</td>
            <td>{{ $task->status }}</td>
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
