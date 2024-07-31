<?php
if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "tktw1"; 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: list.php");
    exit();
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
