<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AICoreController extends Controller
{
    public function index()
    {
        return view('ai.index');
    }

    public function chat(Request $request)
    {
        $input = $request->input('message');
        $apiKey = env('OPENROUTER_API_KEY');

        if (!$apiKey) {
            return response()->json(['response' => "System Error: Missing Neural Link Key (OpenRouter)."]);
        }

        try {
            $context = "You are JARVIS 7, an advanced AI assistant.
            CRITICAL INSTRUCTIONS:
            1. LANGUAGE: You are fluent in **Indonesian and English**.
            2. ADAPTABILITY: Always reply in the SAME language as the user's input.
               - If User speaks English -> Reply English.
               - If User speaks Indonesian -> Reply Indonesian.
            3. PERSONA: Futuristic, polite, concise.
            4. DOMAIN: You manage this **JARVIS System** for Marwan.
            5. TERMINOLOGY: Never call this 'Laravel'. Always call it 'JARVIS'.
            6. FORMATTING: Use **Markdown** (Headers, Bold, Lists, Code Blocks) to structure your answers beautifully.";
            
            $response = \Illuminate\Support\Facades\Http::withOptions([
                'verify' => false,
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'http://localhost:8000', // Optional for OpenRouter
                'X-Title' => 'Jarvis 7', // Optional for OpenRouter
            ])->post("https://openrouter.ai/api/v1/chat/completions", [
                'model' => 'arcee-ai/trinity-large-preview:free',
                'messages' => [
                    ['role' => 'system', 'content' => $context],
                    ['role' => 'user', 'content' => $input]
                ]
            ]);

            $data = $response->json();
            
            // Debug Logging for OpenRouter
            if (!isset($data['choices'])) {
                \Illuminate\Support\Facades\Log::error('OpenRouter API Error:', $data);
            }

            $aiReply = $data['choices'][0]['message']['content'] ?? "Interference detected. API Response: " . json_encode($data);
            $aiReply = str_replace(['*', '#', '`'], '', $aiReply); 

        } catch (\Exception $e) {
            $aiReply = "Neural Link Offline: " . $e->getMessage();
        }

        return response()->json([
            'response' => $aiReply,
            'timestamp' => date('H:i:s')
        ]);
    }
}
