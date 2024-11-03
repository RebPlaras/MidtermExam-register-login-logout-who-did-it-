<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 

    // fetch gpu details
    $getGPUById = getGPUByID($pdo, $_GET['gpuID']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit GPU</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
        }
        input, select {
            font-size: 1.2em;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h3>Edit GPU Information</h3>

    <!-- update form -->
    <form action="../core/handleForms.php?gpuID=<?php echo htmlspecialchars($_GET['gpuID']); ?>" method="POST">
        <p>
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" value="<?php echo htmlspecialchars($getGPUById['brand']); ?>" required>
        </p>
        <p>
            <label for="model">Model</label>
            <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($getGPUById['model']); ?>" required>
        </p>
        <p>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($getGPUById['price']); ?>" required step="0.01" min="0">
        </p>
        <p>
            <label for="in_stock">In Stock</label>
            <select name="in_stock" id="in_stock" required>
                <option value="1" <?php echo ($getGPUById['in_stock'] == 1) ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo ($getGPUById['in_stock'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </p>
        <p>
            <input type="submit" name="editGPUBtn" value="Update">
        </p>
    </form>

</body>
</html>
