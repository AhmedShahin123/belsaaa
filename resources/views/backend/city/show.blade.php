@extends('backend.layouts.app')

@section('title', __('labels.backend.city.management') . ' | ' . __('labels.backend.city.view'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.city.management')
                        <small class="text-muted">@lang('labels.backend.city.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.task.tabs.titles.overview')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>@lang('labels.backend.city.tabs.content.overview.name')</th>
                                            <td>{{ $city->name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('labels.backend.task.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($city->created_at) }} ({{ $city->created_at->diffForHumans() }}),
                        <strong>@lang('labels.backend.task.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($city->updated_at) }} ({{ $city->updated_at->diffForHumans() }})
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

