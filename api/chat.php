<?php
header('Content-Type: application/json');

// This is a proxy for the Gemini API to keep the key secure.
// In a real app, you'd get the API key from an environment variable.
$apiKey = getenv('GEMINI_API_KEY') ?: 'YOUR_GEMINI_API_KEY_HERE';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Only POST requests allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$message = $input['message'] ?? '';

if (!$message) {
    echo json_encode(['error' => 'Message is required']);
    exit;
}

// Prepare the request to Gemini API
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey";

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => "You are Nexus, the AI assistant for PrimeOrbit, a corporate technology company. Be professional, helpful, and concise. User says: " . $message]
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
    echo json_encode(['error' => 'AI Service Unavailable', 'details' => $response]);
    exit;
}

$result = json_decode($response, true);
$botResponse = $result['candidates'][0]['content']['parts'][0]['text'] ?? "I'm having trouble thinking right now.";

echo json_encode(['response' => $botResponse]);

