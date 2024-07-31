<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "tktw1"; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $content = $_POST['content'];
        $date = $_POST['date'];
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];
        
        $sql = "INSERT INTO comments (content, date, customer_id,product_id) VALUES (:content, :date,:customer_id,:product_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':product_id', $product_id);

        $stmt->execute();
       
        header("Location: list.php");
        exit(); 
    } catch(PDOException $e) {
        
        echo "Thêm mới thất bại: " . $e->getMessage();
    }
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
    $sql = "SELECT * FROM detail_products";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $detail_products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $detail_products = [];
    }
    ?>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
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
        <h2>Add new </h2>
        <form method="POST">
        <label for="type">ID User : </label>
            <select class="form-control" name="customer_id" id="">
                <option value="">--Chọn--</option>
                <?php
                foreach ($customers as $val) {
                ?>
                    <option value="<?php echo $val['customer_id'] ?>"><?php echo $val['name_customer'] ?></option>

                <?php } ?>
            </select>
            <label for="type">ID Prd : </label>
            <select class="form-control" name="product_id" id="">
                <option value="">--Chọn--</option>
                <?php
                foreach ($detail_products as $val) {
                ?>
                    <option value="<?php echo $val['product_id'] ?>"><?php echo $val['name_product'] ?></option>

                <?php } ?>
            </select>
            <label for="content">Content:</label>
            <input type="text" id="content" name="content" required>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <input type="submit" value="Thêm danh mục">
        </form>
    </div>
</body>
</html>


