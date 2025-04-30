<?php
header('Content-Type: application/json');

$filename = 'data.txt';
$lastModified = $_GET['lastModified'] ?? 0;
$currentModified = filemtime($filename);
$timeout = 30;
$start = time();

while ($currentModified <= $lastModified && (time() - $start) < $timeout) {
    clearstatcache(); 
    $currentModified = filemtime($filename);
    usleep(100000);
}

if ($currentModified > $lastModified) {
    $content = file_get_contents($filename);
    echo json_encode([
        'updated' => true,
        'lastModified' => $currentModified,
        'content' => $content
    ]);
} else {
    echo json_encode(['updated' => false]);
}
?>