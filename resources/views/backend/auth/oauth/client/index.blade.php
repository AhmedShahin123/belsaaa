@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.client.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.client.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.client.table.user_id')</th>
                                <th>@lang('labels.backend.client.table.name')</th>
                                <th>@lang('labels.backend.client.table.redirect')</th>
                                <th>@lang('labels.backend.client.table.personal_access_token')</th>
                                <th>@lang('labels.backend.client.table.password_client')</th>
                                <th>@lang('labels.backend.client.table.revoked')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->user_id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->redirect }}</td>
                                    <td>@include('backend.includes.partials.boolean', ['value' => $client->personal_access_token])</td>
                                    <td>@include('backend.includes.partials.boolean', ['value' => $client->password_client])</td>
                                    <td>@include('backend.includes.partials.boolean', ['value' => $client->revoked])</td>
                                    <td class="btn-td">@include('backend.auth.oauth.client.includes.actions', ['client' => $client])</td>
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
                        {!! $clients->total() !!} {{ trans_choice('labels.backend.client.table.total', $clients->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $clients->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
