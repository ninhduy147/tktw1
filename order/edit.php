<?php

if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}


$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "tktw1"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $order_date = $_POST['order_date'];
        $customer_id = $_POST['customer_id'];
        $status_id = $_POST['status_id'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $total_amount = $_POST['total_amount'];

        $sql = "UPDATE orders SET name = :name, order_date = :order_date, customer_id = :customer_id, status_id = :status_id, phone_number = :phone_number, address = :address, total_amount = :total_amount WHERE order_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
       
        header("Location: list.php");
        exit(); 
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        header("Location: list.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
<?php
    require "connect.php";
    $sql = "SELECT * FROM customers";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $customers = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $customers = [];
    }
    $sql = "SELECT * FROM statuses";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $statuses = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $statuses = [];
    }
    ?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e4f0f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        .container {
            width: 90%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 3rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2a4158;
            margin-bottom: 1.5rem;
            font-family: 'Roboto', sans-serif;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
            color: #4a5568;
        }

        input[type="text"],
        input[type="text"]:focus {
            padding: 1rem;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1rem;
            color: #2d3748;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #3182ce;
        }

        input[type="submit"] {
            background-color: #3182ce;
            color: #ffffff;
            padding: 1rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 600;
        }

        input[type="submit"]:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Order</h2>
        <form method="POST">
        <label for="type">ID User : </label>
            <select class="form-control" name="customer_id" id="">
                <option value="0">--Chọn--</option>
                <?php
                foreach ($customers as $val) {
                ?>
                    <option value="<?php echo $val['customer_id'] ?>" selected><?php echo $val['name_customer'] ?></option>

                <?php } ?>
            </select>
            <label for="type">ID Status : </label>
            <select class="form-control" name="status_id" id="">
                <option value="0">--Chọn--</option>
                <?php
                foreach ($statuses as $val) {
                ?>
                    <option value="<?php echo $val['status_id'] ?>" selected><?php echo $val['status_name'] ?></option>

                <?php } ?>
            </select>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($order['name']); ?>" required>
            <label for="phone_number">phone_number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($order['phone_number']); ?>" required>
            <label for="address">address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($order['address']); ?>" required>
            <label for="order_date">order_date:</label>
            <input type="date" id="order_date" name="order_date" value="<?php echo htmlspecialchars($order['order_date']); ?>" required>
            <label for="total_amount">total_amount:</label>
            <input type="text" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>
            <input type="submit" value="Cập nhật order">
        </form>
    </div>
</body>
</html>
