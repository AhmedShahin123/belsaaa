<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.employer.tabs.content.employer_attributes.company_name') }}</th>
                <td>{{ $employer->company_name }}</td>
            </tr>
            <tr>
                <th>{{ __('labels.backend.employer.tabs.content.employer_attributes.commercial_email') }}</th>
                <td>{{ $employer->user_attributes->commercial_email }}</td>
            </tr>
            <tr>
                <th>{{ __('labels.backend.employer.tabs.content.employer_attributes.commercial_business_industry') }}</th>
                <td>{{ $employer->user_attributes->commercial_business_industry }}</td>
            </tr>
            <tr>
                <th>{{ __('labels.backend.employer.tabs.content.employer_attributes.office_photo') }}</th>
                <td>
                    <a
                        target="_blank"
                        href="{{ $employer->user_attributes->getFirstMediaUrl('office_photo') }}">
                        {{ __('labels.backend.employer.tabs.content.employer_attributes.download_office_photo') }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>{{ __('labels.backend.employer.tabs.content.employer_attributes.legal_document') }}</th>
                <td>
                    <a
                        target="_blank"
                        href="{{ $employer->user_attributes->getFirstMediaUrl('legal_document') }}">
                        {{ __('labels.backend.employer.tabs.content.employer_attributes.download_legal_document') }}
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
