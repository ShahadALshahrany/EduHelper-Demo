@extends('layouts.app')

@section('title', 'Loading')

@section('content')
<div class="phone">
    <div class="notch"></div>

    <div class="topbar">
        <div class="top-icons">
            <span>☰</span>
            <span>👤</span>
        </div>
        <div class="brand">EDUHELPER</div>
    </div>

    <div class="screen">
        <div class="loader-wrap">
            <div class="loader"></div>
            <div class="loader-text">جاري معالجة المحتوى...</div>
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        window.location.href = "{{ route('result') }}";
    }, 1800);
</script>
@endsection