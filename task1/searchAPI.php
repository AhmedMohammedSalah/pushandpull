<?php
header('Content-Type: text/html');

$query = $_GET['q'] ;


$servername="localhost";
$username="root";
$password="1234";
$dbname ="test";
$myconnection = mysqli_connect($servername,$username,$password,$dbname);
$sql="SELECT * FROM products WHERE productName LIKE '%$query%'";
$result = mysqli_query($myconnection,$sql);
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row['productName'];
}
$results = [];
if (empty($query)) {
    $results[] = 'No results found';
    echo "<div>No results found</div>";
    exit;
}
$query = strtolower($query);

foreach ($items as $item) {
        $results[] = $item;
}
if (empty($results)) {
    $results[] = 'No results found';
}

foreach ($results as $result) {
    echo "<div>$result</div>";
}


?>