<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.address')</th>
                <td>{{ $tasker->user_attributes->address }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.national_number')</th>
                <td>{{ $tasker->user_attributes->national_number }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.gender')</th>
                <td>{{ $tasker->user_attributes->gender }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.birth_date')</th>
                <td>{{ $tasker->user_attributes->birth_date }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.bio')</th>
                <td>{{ $tasker->user_attributes->bio }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.available_until')</th>
                <td>{{ optional($tasker->user_attributes->available_until)->format('Y-m-d') }}</td>
            </tr>
        </table>
    </div>

    <h3>@lang('labels.backend.tasker.tabs.content.tasker_attributes.working_days')</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.shift')</th>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.date')</th>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.start')</th>
                <th>@lang('labels.backend.tasker.tabs.content.tasker_attributes.end')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasker->user_attributes->working_days as $working_day)
                <tr>
                    <th>{{$working_day->shift}}</th>
                    <th>{{$working_day->date->format('Y-m-d')}}</th>
                    <th>{{$working_day->start}}</th>
                    <th>{{$working_day->end}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><!--table-responsive-->
