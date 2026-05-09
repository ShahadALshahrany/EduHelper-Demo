@extends('layouts.app')

@section('title', 'Result')

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
        <div class="pill small-pill">Result</div>

        <div class="spacer-18"></div>

        <!-- اسم الملف -->
        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">File name</div>
            <div id="fileName" style="font-size:14px; color:#444;">—</div>
        </div>

        <!-- النص -->
        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">AI Output</div>
            <div id="textContent" style="font-size:16px; line-height:2; color:#111;">
                جاري تحميل النص...
            </div>
        </div>

        <!-- الملخص -->
        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">AI Summary</div>
            <div id="summaryContent" style="font-size:15px; line-height:2; color:#333; background:#eef6f3; padding:10px; border-radius:10px;">
                جاري إنشاء الملخص...
            </div>
        </div>

        <!-- القراءة -->
        <div class="light-card" style="padding:16px; margin-bottom:18px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <strong style="font-size:16px; color:#2f5c52;">Smart Reading</strong>
                <span id="speechStatus" style="font-size:13px; color:#666;">جاهز</span>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:10px; margin-bottom:14px;">
                <button class="action-btn" onclick="readOriginalText()">🔊 Read Original</button>
                <button class="action-btn" style="background:#cfe7de;" onclick="readSummaryText()">🧠 Read Summary</button>
                <button class="action-btn" style="background:#d9d9d9; grid-column:1/-1;" onclick="stopSpeech()">⏹ Stop</button>
            </div>

            <label>Speed: <span id="speedValue">1.0</span>x</label>
            <input id="speedRange" type="range" min="0.5" max="2" step="0.1" value="1" style="width:100%;">
        </div>

        <!-- Personalization -->
        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">Personalization</div>

            <label>Font size</label>
            <input id="fontSize" type="range" min="14" max="24" value="16" style="width:100%;">

            <label>Contrast</label>
            <select id="contrast">
                <option value="normal">Normal</option>
                <option value="high">High</option>
            </select>
        </div>

        <a href="/tools" class="back-mini">↩ Back</a>
    </div>
</div>

<script>
    // 📥 جلب النص
    const text = sessionStorage.getItem('pdfExtractedText');
    const fileName = sessionStorage.getItem('uploadedFileName');

    const textEl = document.getElementById('textContent');
    const summaryEl = document.getElementById('summaryContent');

    document.getElementById('fileName').innerText = fileName || 'Unknown file';

    const finalText = text && text.trim() ? text : 'No readable text found.';
    textEl.innerText = finalText;

    // 🧠 AI Summary (ذكي)
    function generateSummary(text) {
        if (!text) return 'No summary available';

        const cleaned = text.replace(/\s+/g, ' ').trim();

        const sentences = cleaned.match(/[^.!؟\n]+[.!؟]?/g);

        if (!sentences) return cleaned.slice(0, 150);

        const important = sentences.slice(0, 3);

        return important.map(s => `• ${s.trim()}`).join('\n');
    }

    const summary = generateSummary(finalText);
    summaryEl.innerText = summary;

    // 🎧 الصوت
    const status = document.getElementById('speechStatus');
    const speedRange = document.getElementById('speedRange');
    const speedValue = document.getElementById('speedValue');

    speedRange.oninput = () => speedValue.innerText = speedRange.value;

    function detectLanguage(text) {
        return /[\u0600-\u06FF]/.test(text) ? 'ar-SA' : 'en-US';
    }

    function speak(txt){
        speechSynthesis.cancel();

        if (!txt) return;

        const utter = new SpeechSynthesisUtterance(txt);

        utter.lang = detectLanguage(txt);
        utter.rate = parseFloat(speedRange.value);

        utter.onstart = () => status.innerText = "Reading...";
        utter.onend = () => status.innerText = "Done";
        utter.onerror = () => status.innerText = "Error";

        speechSynthesis.speak(utter);
    }

    function readOriginalText(){
        speak(textEl.innerText);
    }

    function readSummaryText(){
        speak(summaryEl.innerText);
    }

    function stopSpeech(){
        speechSynthesis.cancel();
        status.innerText = "Stopped";
    }

    // 🎨 personalization
    const fontSize = document.getElementById('fontSize');
    const contrast = document.getElementById('contrast');

    fontSize.oninput = () => {
        textEl.style.fontSize = fontSize.value + 'px';
        summaryEl.style.fontSize = fontSize.value + 'px';
    };

    contrast.onchange = () => {
        if(contrast.value === 'high'){
            textEl.style.background = "#000";
            textEl.style.color = "#fff";
            summaryEl.style.background = "#000";
            summaryEl.style.color = "#fff";
        } else {
            textEl.style.background = "#f8fafc";
            textEl.style.color = "#111";
            summaryEl.style.background = "#eef6f3";
            summaryEl.style.color = "#333";
        }
    };
</script>
@endsection