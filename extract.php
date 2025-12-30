<?php
header("Content-Type: application/json");


if (!isset($_FILES['image'])) {
    echo json_encode([
        "success" => false,
        "error" => "No image uploaded"
    ]);
    exit;
}

$image = $_FILES['image'];


$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$targetPath = $uploadDir . time() . "_" . basename($image["name"]);

// Move uploaded file
if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
    echo json_encode([
        "success" => false,
        "error" => "Upload failed"
    ]);
    exit;
}


$extractedData = [
    "customer_name" => "Sample Customer",
    "amount" => "₹2500",
    "date" => date("d-m-Y"),
    "file_saved_as" => $targetPath
];

echo json_encode([
    "success" => true,
    "data" => $extractedData
]);
