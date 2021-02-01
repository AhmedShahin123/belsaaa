@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.contact_category.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.contact_category.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.contact_category.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.contact_category.table.name')</th>
                                <th>@lang('labels.backend.contact_category.table.last_updated')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contactCategories as $contact_category)
                                <tr>
                                    <td>{{ $contact_category->name }}</td>
                                    <td>{{ $contact_category->updated_at->diffForHumans() }}</td>
                                    <td class="btn-td">@include('backend.contact_category.includes.actions', ['contact_category' => $contact_category])</td>
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
                        {!! $contactCategories->total() !!} {{ trans_choice('labels.backend.contact_category.table.total', $contactCategories->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $contactCategories->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
