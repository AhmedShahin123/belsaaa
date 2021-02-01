@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.tasker.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.tasker.management') }}
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('admin.tasker.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                    </div><!--btn-toolbar-->
                </div>
            </div><!--row-->

            <div class="row">
                <div class="col-sm-6">
                    @include('backend.tasker.index.filters')
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.tasker.table.first_name')</th>
                                <th>@lang('labels.backend.tasker.table.last_name')</th>
                                <th>@lang('labels.backend.tasker.table.email')</th>
                                <th>@lang('labels.backend.tasker.table.cellphone')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($taskers as $tasker)
                                <tr>
                                    <td>{{ $tasker->first_name }}</td>
                                    <td>{{ $tasker->last_name }}</td>
                                    <td>{{ $tasker->email }}</td>
                                    <td>{{ $tasker->cellphone }}</td>
                                    <td class="btn-td">@include('backend.tasker.includes.actions', ['tasker' => $tasker])</td>
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
                        {!! $taskers->total() !!} {{ trans_choice('labels.backend.tasker.table.total', $taskers->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $taskers->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
