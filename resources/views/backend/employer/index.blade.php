@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.employer.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.employer.management') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('admin.employer.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                    </div><!--btn-toolbar-->
                </div>
            </div><!--row-->

            <div class="row">
                <div class="col-sm-6">
                    @include('backend.employer.index.filters')
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.employer.table.company_name')</th>
                                <th>@lang('labels.backend.employer.table.email')</th>
                                <th>@lang('labels.backend.employer.table.cellphone')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employers as $employer)
                                <tr>
                                    <td>{{ $employer->company_name ?? ($employer->first_name.' '.$employer->last_name) }}</td>
                                    <td>{{ $employer->email }}</td>
                                    <td>{{ $employer->cellphone }}</td>
                                    <td class="btn-td">@include('backend.employer.includes.actions', ['employer' => $employer])</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $employers->total() !!} {{ trans_choice('labels.backend.employer.table.total', $employers->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $employers->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
