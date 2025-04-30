<?php
header('Content-Type: application/json');

$productId = $_POST['id'] ?? 0;

echo json_encode([
    'success' => true,
    'message' => 'Product deleted successfully'
]);
?>