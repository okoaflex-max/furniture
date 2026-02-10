<?php
include 'config.php';

// Basic antibot functionality
if ($antibot === "yes") {
    // Simple bot detection based on user agent
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $bot_patterns = ['bot', 'crawler', 'spider', 'scraper', 'curl', 'wget'];
    
    foreach ($bot_patterns as $pattern) {
        if (stripos($user_agent, $pattern) !== false) {
            die("Access denied: Bot detected");
        }
    }
    
    // Block proxies if enabled
    if ($block_proxy === "yes") {
        $proxy_headers = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_VIA',
            'HTTP_X_COMING_FROM',
            'HTTP_COMING_FROM'
        ];
        
        foreach ($proxy_headers as $header) {
            if (!empty($_SERVER[$header])) {
                die("Access denied: Proxy/VPN not allowed");
            }
        }
    }
}
?>
