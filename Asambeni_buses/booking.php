<?php

// Dummy data for bus information
$busInfo = [
    'greyhound' => ['time' => '10:00 AM', 'price' => '$20'],
    'intercape' => ['time' => '2:00 PM', 'price' => '$25'],
    'intercity' => ['time' => '1:30 PM', 'price' => '$18'],
    'eldocoach' => ['time' =>]'6:00'
];

if (isset($_POST['busType']) && array_key_exists($_POST['busType'], $busInfo)) {
    $selectedBusType = $_POST['busType'];
    $time = $busInfo[$selectedBusType]['time'];
    $price = $busInfo[$selectedBusType]['price'];

    echo "<p>Bus Time: $time</p>";
    echo "<p>Bus Price: $price</p>";
} else {
    echo "Invalid bus type.";
}

?>
