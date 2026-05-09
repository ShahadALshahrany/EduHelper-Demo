<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TtsController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'text' => ['required', 'string', 'max:12000'],
        ]);

        $text = trim($request->text);

        if ($text === '') {
            return response()->json([
                'success' => false,
                'message' => 'النص فارغ',
            ], 422);
        }

        $speechKey = env('AZURE_SPEECH_KEY');
        $speechRegion = env('AZURE_SPEECH_REGION');
        $voice = env('AZURE_SPEECH_VOICE', 'ar-SA-ZariyahNeural');

        if (!$speechKey || !$speechRegion) {
            return response()->json([
                'success' => false,
                'message' => 'إعدادات Azure Speech غير موجودة في ملف .env',
            ], 500);
        }

        $ssml = <<<SSML
<speak version="1.0" xml:lang="ar-SA">
    <voice name="{$voice}">
        <prosody rate="0%" pitch="0%">
            {$this->escapeForXml($text)}
        </prosody>
    </voice>
</speak>
SSML;

        $endpoint = "https://{$speechRegion}.tts.speech.microsoft.com/cognitiveservices/v1";

        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $speechKey,
            'Content-Type' => 'application/ssml+xml',
            'X-Microsoft-OutputFormat' => 'audio-16khz-32kbitrate-mono-mp3',
            'User-Agent' => 'EduHelperDemo',
        ])->withBody($ssml, 'application/ssml+xml')
          ->timeout(60)
          ->post($endpoint);

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'فشل إنشاء الصوت من Azure',
                'details' => $response->body(),
            ], 500);
        }

        $dir = public_path('generated-audio');

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $fileName = 'tts_' . Str::uuid() . '.mp3';
        $filePath = $dir . DIRECTORY_SEPARATOR . $fileName;

        File::put($filePath, $response->body());

        return response()->json([
            'success' => true,
            'audio_url' => asset('generated-audio/' . $fileName),
        ]);
    }

    private function escapeForXml(string $text): string
    {
        return htmlspecialchars($text, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}