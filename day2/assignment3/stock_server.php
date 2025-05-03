<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

function sendStockUpdate() {
    $stocks = [
        ['symbol' => 'AAPL', 'name' => 'Apple Inc.'],
        ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.'],
        ['symbol' => 'MSFT', 'name' => 'Microsoft Corporation'],
        ['symbol' => 'AMZN', 'name' => 'Amazon.com Inc.'],
        ['symbol' => 'TSLA', 'name' => 'Tesla Inc.']
    ];
    
    $update = [];
    foreach ($stocks as $stock) {
        $price = rand(100, 1000) + (rand(0, 99) / 100);
        $change = rand(-500, 500) / 100;
        $percentChange = ($change / $price) * 100;
        
        $update[] = [
            'symbol' => $stock['symbol'],
            'name' => $stock['name'],
            'price' => number_format($price, 2),
            'change' => ($change > 0 ? '+' : '') . number_format($change, 2),
            'percentChange' => ($percentChange > 0 ? '+' : '') . number_format($percentChange, 2) . '%',
            'timestamp' => date('H:i:s')
        ];
    }
    
    echo "data: " . json_encode($update) . "\n\n";
    ob_flush();
    flush();
}

while (true) {
    sendStockUpdate();
    sleep(2);
}
?>
