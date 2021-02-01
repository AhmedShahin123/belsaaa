{{ html()->hidden('user_type') }}

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.active'))->class('col-md-2 form-control-label')->for('active') }}

    <div class="col-md-10">
        {{ html()->select('active')->options(['0' => 'No', '1' => 'Yes'])->value($tasker->active ? '1' : '0')
            ->class('form-control') }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

    <div class="col-md-10">
        {{ html()->text('first_name')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.first_name'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

    <div class="col-md-10">
        {{ html()->text('last_name')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.last_name'))
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
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password') }}

    <div class="col-md-10">
        {{ html()->password('password')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.password'))
            ->value(null)
            ->required(!$tasker->id) }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

    <div class="col-md-10">
        {{ html()->password('password_confirmation')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
            ->required(!$tasker->id) }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.tasker.user_attributes.address'))->class('col-md-2 form-control-label')->for('address') }}

    <div class="col-md-10">
        {{ html()->textarea('user_attributes[address]', $tasker->user_attributes->address)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.tasker.user_attributes.address'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.tasker.user_attributes.national_number'))->class('col-md-2 form-control-label')->for('user_attributes.national_number') }}

    <div class="col-md-10">
        {{ html()->text('user_attributes[national_number]', $tasker->user_attributes->national_number)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.tasker.user_attributes.national_number'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.tasker.user_attributes.gender'))->class('col-md-2 form-control-label')->for('user_attributes.gender') }}

    <div class="col-md-10">
        {{ html()->select('user_attributes[gender]', [
                'male' => __('validation.attributes.backend.task.required_tasker_gender_male'),
                'female' => __('validation.attributes.backend.task.required_tasker_gender_female')
            ], $tasker->user_attributes->gender)
            ->class('form-control')
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.tasker.user_attributes.birth_date'))->class('col-md-2 form-control-label')->for('user_attributes.birth_date') }}

    <div class="col-md-10">
        {{ html()->date('user_attributes[birth_date]', $tasker->user_attributes->birth_date)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.tasker.user_attributes.birth_date'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.tasker.user_attributes.bio'))->class('col-md-2 form-control-label')->for('user_attributes.bio') }}

    <div class="col-md-10">
        {{ html()->textarea('user_attributes[bio]', $tasker->user_attributes->bio)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.tasker.user_attributes.bio'))
            ->required() }}
    </div><!--col-->
</div><!--form-group-->
