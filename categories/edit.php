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
        $status_id = $_POST['status_id'];
        $sql = "UPDATE categories SET name = :name, status_id = :status_id WHERE category_id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: list.php");
        exit(); 
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE category_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        header("Location: list.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
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
        <h2>Edit Category</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
            <label for="status_id">Status ID:</label>
            <input type="text" id="status_id" name="status_id" value="<?php echo htmlspecialchars($category['status_id']); ?>" required>
            <input type="submit" value="Update Category">
        </form>
    </div>
</body>
</html>
