@extends('layouts.app')

@section('title', 'EduHelper Tools')

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
        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">Welcome, User</div>
            <div style="font-size:14px; color:#444; line-height:1.8;">
                EduHelper is ready to support accessibility inside and outside campus.
            </div>
        </div>

        <div class="light-card" style="margin-bottom:18px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                <div class="section-title">Campus Mode</div>
                <span class="mini-tag">Active in campus</span>
            </div>
            <ul class="help-list">
                <li>قراءة ملفات الجامعة</li>
                <li>قراءة الإعلانات واللوحات</li>
                <li>دعم المقررات والمحتوى الأكاديمي</li>
                <li>تبسيط المحتوى للطلاب ومنسوبي الجامعة</li>
            </ul>
        </div>

        <div class="center">
            <div class="pill">Choose a Tool</div>
        </div>

        <div class="spacer-18"></div>

        <div class="card">
            <div class="option-row clickable-option" onclick="window.location='/image-to-speech'">
                <div class="radio" style="background:#111;"></div>
                <div>Text to Speech</div>
            </div>

            <div class="option-row clickable-option" onclick="showSoonMessage()">
                <div class="radio"></div>
                <div>Sign Language</div>
            </div>

            <div class="option-row clickable-option" onclick="showSoonMessage()">
                <div class="radio"></div>
                <div>Visual Highlight</div>
            </div>
        </div>

        <div class="spacer-18"></div>

        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">Quick Actions</div>
            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:10px;">
                <button class="action-btn" type="button" style="font-size:14px;" onclick="window.location='/image-to-speech'">Upload File</button>
                <button class="action-btn" type="button" style="font-size:14px; background:#d9d9d9;" onclick="showSoonMessage()">Scan Notice</button>
            </div>
        </div>

        <div class="light-card">
            <div class="section-title">How EduHelper helps the university</div>
            <ul class="help-list">
                <li>دعم الشمولية الرقمية</li>
                <li>مساعدة الطلاب ذوي الاحتياجات الخاصة</li>
                <li>تسهيل الوصول للمحتوى الجامعي</li>
                <li>دعم أعضاء هيئة التدريس في تقديم محتوى أكثر مرونة</li>
            </ul>
        </div>

        <div class="spacer-18"></div>

        <div id="toastMessage" style="
            display:none;
            background:#fff3cd;
            color:#856404;
            border:1px solid #ffeaa7;
            padding:12px;
            border-radius:12px;
            text-align:center;
            font-size:16px;
            font-weight:700;
        ">
            قريبًا
        </div>
    </div>
</div>

<script>
    function showSoonMessage() {
        const toast = document.getElementById('toastMessage');
        toast.style.display = 'block';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 1800);
    }
</script>
@endsection