
<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.active'))->class('col-md-2 form-control-label')->for('active') }}

    <div class="col-md-10">
        {{ html()->select('active')->options(['0' => 'No', '1' => 'Yes'])->value($employer->active ? '1' : '0')
            ->class('form-control') }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.company_name'))->class('col-md-2 form-control-label')->for('company_name') }}

    <div class="col-md-10">
        {{ html()->text('company_name')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.company_name'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->


<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.cellphone'))->class('col-md-2 form-control-label')->for('cellphone') }}

    <div class="col-md-10">
        {{ html()->text('cellphone')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.cellphone'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

    <div class="col-md-10">
        {{ html()->email('email')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.email'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group--><div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password') }}

    <div class="col-md-10">
        {{ html()->password('password')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.password'))
            ->value(null)
            ->required(!$employer->id) }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

    <div class="col-md-10">
        {{ html()->password('password_confirmation')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
            ->required(!$employer->id) }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.location'))->class('col-md-2 form-control-label') }}
    <div class="col-md-10">
        {{html()->hidden('latitude')->id('employer-latitude')}}
        {{html()->hidden('longitude')->id('employer-longitude')}}
        <task-location :enable-selection="true" latitude-field-id="employer-latitude" longitude-field-id="employer-longitude" :point="{latitude: {{$employer->latitude ?? 26.4207}}, longitude:{{$employer->longitude ?? 50.0888}}}"></task-location>
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.employer.user_attributes.commercial_business_industry'))->class('col-md-2 form-control-label')->for('user_attributes.commercial_business_industry') }}

    <div class="col-md-10">
        {{ html()->text('user_attributes[commercial_business_industry]', $employer->user_attributes->commercial_business_industry)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.employer.user_attributes.commercial_business_industry'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.employer.user_attributes.office_photo'))->class('col-md-2 form-control-label')->for('user_attributes.commercial_business_industry') }}

    <div class="col-md-10">
        @if(!$employer->id)
            {{ html()->file('user_attributes[office_photo]')
                ->class('form-control')
                ->required() }}
        @else
            {{ html()->file('user_attributes[office_photo]')
                ->class('form-control') }}

            <a
                target="_blank"
                href="{{ $employer->user_attributes->getFirstMediaUrl('office_photo') }}">
                {{ __('labels.backend.employer.tabs.content.employer_attributes.download_office_photo') }}
            </a>
        @endif
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.employer.user_attributes.legal_document'))->class('col-md-2 form-control-label')->for('user_attributes.commercial_business_industry') }}

    <div class="col-md-10">
        @if(!$employer->id)
            {{ html()->file('user_attributes[legal_document]')
                ->class('form-control')
                ->required() }}
        @else
            {{ html()->file('user_attributes[legal_document]')
                ->class('form-control') }}

            <a
                target="_blank"
                href="{{ $employer->user_attributes->getFirstMediaUrl('legal_document') }}">
                {{ __('labels.backend.employer.tabs.content.employer_attributes.download_legal_document') }}
            </a>
        @endif
    </div><!--col-->
</div><!--form-group-->
