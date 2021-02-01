@extends('backend.layouts.app')

@section('title', __('labels.backend.employer.management') . ' | ' . __('labels.backend.employer.view'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.employer.management')
                        <small class="text-muted">@lang('labels.backend.employer.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assignment_requests" role="tab" aria-controls="assignment_requests" aria-expanded="true"><i class="fas fa-users"></i> @lang('labels.backend.employer.tabs.titles.employer_attributes')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.auth.user.show.tabs.overview', ['user' => $employer])
                        </div><!--tab-->
                        <div class="tab-pane" id="assignment_requests" role="tabpanel" aria-expanded="true">
                            @include('backend.employer.show.tabs.attributes')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('labels.backend.employer.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($employer->created_at) }} ({{ $employer->created_at->diffForHumans() }}),
                        <strong>@lang('labels.backend.employer.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($employer->updated_at) }} ({{ $employer->updated_at->diffForHumans() }})
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

