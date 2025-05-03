<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

function sendMessage($event, $data) {
    echo "event: $event\n";
    echo "data: $data\n\n";
    ob_flush();
    flush();
}

$messages = [
    "System alert: CPU usage high",
    "New user registered",
    "Database backup completed",
    "Security scan running",
    "Server maintenance scheduled"
];

while (true) {
    $randomMessage = $messages[array_rand($messages)];
    $timestamp = date('Y-m-d H:i:s');
    $fullMessage = "[$timestamp] $randomMessage";  
    sendMessage("notification", $fullMessage);
    
    sleep(3);
}
?>