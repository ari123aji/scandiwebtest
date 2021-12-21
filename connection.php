<?php
$conn = mysqli_connect("localhost", "root", "", "scandiwebtest");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function createData($data)
{
    global $conn;
    $sku = htmlspecialchars($data["sku"]);
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $productType = htmlspecialchars($data["productType"]);
    $size = htmlspecialchars($data["size"]);
    $weight = htmlspecialchars($data["weight"]);
    $height = htmlspecialchars($data["height"]);
    $width = htmlspecialchars($data["width"]);
    $length = htmlspecialchars($data["length"]);

    $query = "INSERT INTO product
        Values
    ('', '$sku', '$name', '$price', '$productType', '$size', '$weight', '$height', '$width', '$length')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
