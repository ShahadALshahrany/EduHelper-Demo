@extends('layouts.app')

@section('title', 'Processing')

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
            <div class="progress-text">
                Extracting text...<br>
                Analyzing content...<br>
                Preparing output...
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        window.location.href = "{{ route('result') }}";
    }, 2200);
</script>
@endsection