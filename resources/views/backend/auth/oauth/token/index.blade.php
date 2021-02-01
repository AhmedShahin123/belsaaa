@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.token.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.token.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.token.table.user_id')</th>
                                <th>@lang('labels.backend.token.table.client_id')</th>
                                <th>@lang('labels.backend.token.table.expires_at')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tokens as $token)
                                <tr>
                                    <td>{{ $token->user_id }}</td>
                                    <td>{{ $token->client_id }}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $token->expires_at)->diffForHumans() }}</td>
                                    <td class="btn-td">@include('backend.auth.oauth.token.includes.actions', ['token' => $token])</td>
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
                        {!! $tokens->total() !!} {{ trans_choice('labels.backend.token.table.total', $tokens->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $tokens->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
