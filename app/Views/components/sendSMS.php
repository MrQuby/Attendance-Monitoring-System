<?php
    // TextBee API Configuration
    $deviceId = "674a0e35da6093cc29102247";
    $apiKey = "7454fece-8d3e-48f3-84e7-1df9656999de";
    $url = "https://api.textbee.dev/api/v1/gateway/devices/" . $deviceId . "/send-sms";

    $data = json_decode(file_get_contents('php://input'), true);
    $phoneNumber = $data['phone_number'] ?? '';
    $message = $data['message'] ?? '';

    if (empty($phoneNumber) || empty($message)) {
        echo json_encode([
            'success' => false,
            'message' => 'Phone number or message missing'
        ]);
        exit;
    }

    $postData = json_encode([
        'recipients' => [$phoneNumber],
        'message' => $message
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => [
            "x-api-key: $apiKey",
            "Content-Type: application/json"
        ]
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to send SMS request'
        ]);
        exit;
    }

    $responseData = json_decode($response, true);

    // Handle response
    if ($httpCode === 200 && isset($responseData['success']) && $responseData['success'] === true) {
        echo json_encode(['success' => true]);
    } else {
        error_log("TextBee API Error: " . ($responseData['message'] ?? 'Unknown error'));
        echo json_encode([
            'success' => false,
            'message' => $responseData['message'] ?? 'Unknown error from TextBee'
        ]);
    }
?>
