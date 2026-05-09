@extends('layouts.app')

@section('title', 'Upload File')

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
        <div class="center">
            <div class="pill">Upload File</div>
        </div>

        <div class="spacer-18"></div>

        <div class="light-card" style="margin-bottom:18px;">
            <div class="section-title">Selected service</div>
            <div style="font-size:14px; color:#444;">Text to Speech is currently active.</div>
        </div>

        <div class="upload-area" style="padding:20px; display:block; height:auto;">
            <input id="uploadedFile" type="file" accept=".txt,.pdf" style="width:100%; font-size:16px;">

            <div id="filePreview" style="margin-top:12px; font-size:14px; color:#555; text-align:center;">
                Upload a TXT or PDF file to continue
            </div>
        </div>

        <div class="spacer-18"></div>

        <button class="action-btn" type="button" onclick="goToProcessing()">
            Analyze Content
        </button>

        <div class="spacer-18"></div>

        <div id="statusMessage" style="font-size:14px; color:#2f5c52; text-align:center; line-height:1.8;"></div>

        <div class="spacer-18"></div>

        <div class="light-card">
            <div class="section-title">What will happen next?</div>
            <ul class="help-list">
                <li>Extracting text</li>
                <li>Analyzing content</li>
                <li>Preparing audio output</li>
            </ul>
        </div>
    </div>
</div>

<script type="module">
    import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.6.82/pdf.min.mjs';

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.6.82/pdf.worker.min.mjs';

    const fileInput = document.getElementById('uploadedFile');
    const filePreview = document.getElementById('filePreview');
    const statusMessage = document.getElementById('statusMessage');

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            filePreview.innerText = 'Selected file: ' + fileInput.files[0].name;
            statusMessage.innerText = '';
        } else {
            filePreview.innerText = 'Upload a TXT or PDF file to continue';
        }
    });

    window.goToProcessing = async function () {
        if (!fileInput.files.length) {
            statusMessage.innerText = 'Please upload a file first.';
            return;
        }

        const file = fileInput.files[0];
        const fileName = file.name.toLowerCase();
        let extractedText = '';

        statusMessage.innerText = 'Reading file...';

        try {
            // TXT
            if (fileName.endsWith('.txt')) {
                extractedText = await file.text();
            }
            // PDF
            else if (fileName.endsWith('.pdf')) {
                const buffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: buffer }).promise;

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const content = await page.getTextContent();
                    const text = content.items.map(item => item.str).join(' ');
                    extractedText += text + '\n\n';
                }
            }
            else {
                statusMessage.innerText = 'Only TXT and PDF are supported in this demo.';
                return;
            }

            extractedText = extractedText.trim();

            if (!extractedText) {
                statusMessage.innerText = 'No readable text found in file.';
                return;
            }

            sessionStorage.setItem('uploadedFileName', file.name);
            sessionStorage.setItem('pdfExtractedText', extractedText);

            window.location.href = "{{ route('processing') }}";
        } catch (error) {
            console.error(error);
            statusMessage.innerText = 'Error reading file.';
        }
    };
</script>
@endsection