<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <style>
body {
    
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #f0f2f5; 
    color: #1c1e21; 
    margin: 0;
    padding: 0;
}

h1 {
    background-color: #4267b2; 
    color: #fff;
    padding: 20px;
    text-align: center;
    font-size: 32px;
    font-weight: 500;
}
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px 20px;
    text-align: left;
    border-bottom: 1px solid #e5e5e5;
}
th {
    background-color: #f0f2f5; 
    font-weight: 500;
}
tr:nth-child(even) {
    background-color: #f0f2f5;
}

a {
    color: #4267b2;
    text-decoration: none;
}

a:hover {
    color: #3b5998;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    font-size: 16px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #4267b2;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #3b5998;
}

.btn-danger {
    background-color: #f44336;
    border: none;
}

.btn-danger:hover {
    background-color: #e53935;
}

    </style>
</head>
<body>
    <h1>Order Management</h1>

    <?php
    require "connect.php";
    $sql = "SELECT * FROM orders";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $orders = [];
    }
    ?>

    <table border="1">
        <thead>
            <tr>
            <th>Order ID</th>
            <th>ID User</th>
            <th>name</th>
            <th>phone_number</th>
            <th>address</th>
            <th>status_id </th>
            <th>order_date</th>
            <th>total_amount</th>
            <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            foreach ($orders as $od): ?>
            <tr>
                <td><?php echo $od['order_id']; ?></td>
                <td><?php echo $od['customer_id']; ?></td>
                <td><?php echo $od['name']; ?></td>
                <td><?php echo $od['phone_number']; ?></td>
                <td><?php echo $od['address']; ?></td>
                <td><?php echo $od['status_id']; ?></td>
                <td><?php echo $od['order_date']; ?></td>
                <td><?php echo $od['total_amount']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $od['order_id']?>">Edit</a>   |
                    <a href="#" onclick="confirmDelete(<?php echo $od['order_id']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                <button><p><a href="add.php">Add New Order</a></p></button>
    <script>
        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</body>
</html>
