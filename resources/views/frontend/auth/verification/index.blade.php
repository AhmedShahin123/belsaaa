@extends($layout)
@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <h2 class="card-header">Verify your phone</h2>
                <div class="card-body">
                    <p>Thanks for registering with our platform. We will call you to verify your phone number in a jiffy. Provide the code below.</p>

                    <div class="d-flex justify-content-center">
                        <div class="col-8">
                            <form method="post" action="{{ route($section.'.auth.phone_verification.verify') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Verification Code</label>
                                    <input id="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" type="text" placeholder="Verification Code" required autofocus>
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="verify" class="btn btn-success"/>
                                </div>
                            </form>
                            <form method="post" action="{{ route($section.'.auth.phone_verification.resend') }}">
                                <p>You can request to resend the verification code.</p>
                                @csrf
                                <input type="submit" value="resend" class="btn btn-primary"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_title')
    <ul class="breadcrumb">
        <li>
            <a href="{{route('frontend.index')}}">Home</a>
        </li>
        <li class="active">
            Verify your phone
        </li>
    </ul>
@endsection
