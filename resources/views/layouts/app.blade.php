<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduHelper')</title>
    <style>
        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
        }

        body{
            font-family: Arial, sans-serif;
            background:#e9ebe3;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px 15px;
        }

        .phone{
            width:360px;
            min-height:740px;
            background:#f4f5f7;
            border:14px solid #000;
            border-radius:46px;
            position:relative;
            overflow:hidden;
            box-shadow:0 20px 35px rgba(0,0,0,.18);
        }

        .notch{
            width:160px;
            height:28px;
            background:#000;
            border-radius:0 0 18px 18px;
            position:absolute;
            top:0;
            left:50%;
            transform:translateX(-50%);
            z-index:10;
        }

        .topbar{
            height:120px;
            background:#2f5c52;
            color:#fff;
            padding:48px 20px 18px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .brand{
            font-size:22px;
            font-weight:800;
            letter-spacing:.5px;
        }

        .top-icons{
            display:flex;
            gap:14px;
            align-items:center;
            font-size:26px;
        }

        .screen{
            padding:20px 18px 28px;
            min-height:620px;
            background:linear-gradient(180deg,#eef2f5 0%, #f4f5f7 100%);
        }

        .pill{
            background:#7da99d;
            color:#111;
            border:3px solid #4d4c8c;
            border-radius:14px;
            padding:8px 14px;
            display:inline-block;
            font-weight:700;
            font-size:22px;
            line-height:1.2;
            text-align:center;
        }

        .small-pill{
            min-width:145px;
            font-size:19px;
            padding:7px 12px;
        }

        .center{
            text-align:center;
        }

        .spacer-12{ height:12px; }
        .spacer-18{ height:18px; }
        .spacer-24{ height:24px; }
        .spacer-30{ height:30px; }

        .card{
            background:#e9e6e8;
            border-radius:16px;
            padding:18px 16px;
        }

        .light-card{
            background:#f8fafc;
            border-radius:10px;
            padding:14px;
        }

        .option-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
            margin:16px 0;
            font-size:18px;
            color:#111;
            font-weight:500;
        }

        .radio{
            width:18px;
            height:18px;
            border:3px solid #111;
            border-radius:50%;
            flex-shrink:0;
            background:#fff;
        }

        .upload-area{
            width:100%;
            min-height:180px;
            border:2px solid #9e9e9e;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:2px;
            position:relative;
        }

        .action-btn{
            width:100%;
            border:none;
            cursor:pointer;
            background:#7da99d;
            color:#111;
            border:3px solid #4d4c8c;
            border-radius:14px;
            padding:10px 14px;
            font-size:20px;
            font-weight:700;
        }

        .back-mini{
            display:inline-block;
            background:#7da99d;
            color:#111;
            border:3px solid #4d4c8c;
            border-radius:12px;
            padding:4px 14px;
            font-weight:700;
            text-decoration:none;
            font-size:18px;
        }

        .login-screen{
            background:#efefef;
            min-height:100%;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:24px 18px 30px;
            position:relative;
        }

        .logo-wrap{
            text-align:center;
            margin-bottom:30px;
        }

        .logo-book{
            font-size:72px;
            color:#7da99d;
            line-height:1;
        }

        .logo-text{
            color:#2f5c52;
            font-size:44px;
            font-weight:700;
            margin-top:4px;
        }

        .login-card{
            width:100%;
            background:#fff;
            border-radius:20px;
            padding:22px 18px 20px;
            box-shadow:0 8px 20px rgba(0,0,0,.08);
        }

        .input{
            width:100%;
            background:#efe9ea;
            border:none;
            border-radius:22px;
            padding:16px 18px;
            font-size:18px;
            margin-bottom:14px;
            outline:none;
        }

        .remember-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:12px;
            color:#6c84b7;
            margin-bottom:14px;
            direction:ltr;
        }

        .login-btn{
            width:100%;
            border:none;
            background:#71a89c;
            color:#fff;
            border-radius:24px;
            padding:15px;
            font-size:18px;
            font-weight:700;
            cursor:pointer;
        }

        .create-row{
            text-align:center;
            font-size:13px;
            margin-top:18px;
            color:#222;
        }

        .create-row a{
            color:#73a6e6;
            text-decoration:none;
            font-weight:700;
        }

        .clickable-option{
            cursor:pointer;
            border-radius:12px;
            padding:8px 6px;
            transition:0.2s;
        }

        .clickable-option:hover{
            background:rgba(125,169,157,0.15);
        }

        .section-title{
            font-size:16px;
            font-weight:700;
            color:#2f5c52;
            margin-bottom:10px;
        }

        .mini-tag{
            display:inline-block;
            background:#dcebe5;
            color:#2f5c52;
            font-size:12px;
            padding:6px 10px;
            border-radius:999px;
            font-weight:700;
        }

        .loader-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            min-height:500px;
            gap:18px;
        }

        .loader{
            width:72px;
            height:72px;
            border:8px solid #d9d9d9;
            border-top-color:#2f5c52;
            border-radius:50%;
            animation:spin 1s linear infinite;
        }

        @keyframes spin{
            to{ transform:rotate(360deg); }
        }

        .progress-text{
            color:#2f5c52;
            font-size:16px;
            text-align:center;
            line-height:1.8;
        }

        .help-list{
            font-size:14px;
            color:#333;
            line-height:1.8;
            padding-right:18px;
        }

        .help-list li{
            margin-bottom:6px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>