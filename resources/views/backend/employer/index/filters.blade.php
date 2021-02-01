<form class="form-inline">
    <div class="form-group">
        {{html()->input('text' ,'term')->class('form-control')->placeholder(__('strings.email_cellphone_name'))->value(request('term', null))}}
        <button type="submit" class="btn btn-primary ml-3">{{ __('strings.filter') }}</button>
    </div>
</form>
