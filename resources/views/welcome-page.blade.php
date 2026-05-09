@extends('layouts.app')

@section('title', 'EduHelper Login')

@section('content')
<div class="phone">
    <div class="notch"></div>

    <div class="login-screen">
        <div class="logo-wrap">
            <div class="logo-book">📖</div>
            <div class="logo-text">EduHelper</div>
        </div>

        <div class="login-card">
            <input class="input" type="email" placeholder="Email">
            <input class="input" type="password" placeholder="Password">

            <div class="remember-row">
                <span>☐ Remember Me</span>
                <span>Forgot Password?</span>
            </div>

            <button class="login-btn" onclick="window.location='/tools'">Login</button>

            <div class="create-row">
                Welcome to your smart accessibility assistant
            </div>
        </div>
    </div>
</div>
@endsection