<?php
include 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, price, quantity) VALUES (?, ?, ?, ?)");
    foreach ($data as $item) {
        $stmt->bind_param("isdi", $item['id'], $item['name'], $item['price'], $item['quantity']);
        $stmt->execute();
    }
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "No data received"]);
}

$stmt->close();
$conn->close();
?>