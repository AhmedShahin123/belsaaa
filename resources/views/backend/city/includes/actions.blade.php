<div class="btn-group" role="group" aria-label="@lang('labels.backend.city.city_actions')">
    <a href="{{ route('admin.city.show', $city) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{ route('admin.city.edit', $city) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
</div>
