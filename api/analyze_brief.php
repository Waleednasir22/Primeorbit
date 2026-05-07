<?php
header('Content-Type: application/json');

$apiKey = getenv('GEMINI_API_KEY') ?: 'YOUR_GEMINI_API_KEY_HERE';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Only POST requests allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$brief = $input['brief'] ?? '';

if (!$brief) {
    echo json_encode(['error' => 'Brief is required']);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey";

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => "You are a senior project manager at PrimeOrbit, a corporate technology company Analyze the following project brief and provide a professional evaluation in HTML format (using <h3>, <p>, <ul>, <li>, <strong>). Focus on: 1. Core Objectives, 2. Technical Complexity, 3. Suggested Technology Stack, 4. Estimated Development Phase. Brief: " . $brief]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['error' => 'AI Service Unavailable']);
    exit;
}

$result = json_decode($response, true);
$analysis = $result['candidates'][0]['content']['parts'][0]['text'] ?? "Unable to analyze brief.";

echo json_encode(['analysis' => $analysis]);

