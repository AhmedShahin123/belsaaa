@if($value)
    <span class='badge badge-success'>{{ isset($active_label) ? $active_label : __('labels.general.yes') }}</span>
@else
    <span class='badge badge-danger'>{{ isset($inactive_label) ? $active_label : __('labels.general.no') }}</span>
@endif
