@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.skill.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.skill.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.skill.table.name')</th>
                                <th>@lang('labels.backend.skill.table.last_updated')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skills as $skill)
                                <tr>
                                    <td>{{ $skill->name }}</td>
                                    <td>{{ $skill->updated_at->diffForHumans() }}</td>
                                    <td class="btn-td">@include('backend.skill.includes.actions', ['skill' => $skill])</td>
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
                        {!! $skills->total() !!} {{ trans_choice('labels.backend.skill.table.total', $skills->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $skills->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
