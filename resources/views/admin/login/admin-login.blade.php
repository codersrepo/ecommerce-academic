@extends('layouts.login-layout')
@section('main-content')

<div class="content">
    <div class="brand">
        <a class="link" href="index.html">Login</a>
    </div>
    <form id="login-form" action="{{ route('admin.login') }}" method="post">
        @csrf
        <h2 class="login-title">{{ config('app.name') }}</h2>
        @if(Session::has('error'))
        <span class="alert aletr-danger">{{ (Session::get('error')) }}</span>
        @endif
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group d-flex justify-content-between">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox">
                <span class="input-span"></span>Remember me</label>
            <a href="forgot_password.html">Forgot password?</a>
        </div>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Login</button>
        </div>

    </form>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $('#login-form').validate({
            errorClass: "help-block",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
@endsection
