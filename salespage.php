<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Shop Sales</title>
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
        table {
            width: 80%;
            margin-top: 50px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h3>Reb's GPU Shop</h3>

    <!-- Show Available GPUs -->
    <table>
        <thead>
            <tr>
                <th>GPU ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
                <th>In Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $gpuRecords = seeGPURecords($pdo); 
            foreach ($gpuRecords as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['gpuID']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand']); ?></td>
                    <td><?php echo htmlspecialchars($row['model']); ?></td>
                    <td><?php echo htmlspecialchars(number_format((float)$row['price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['in_stock'] ? 'Yes' : 'No'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Sales Form -->
    <h3>Buy a GPU</h3>
    <form action="../core/handleForms.php" method="POST">
        <p>
            <label for="gpuID">GPU ID</label>
            <input type="number" name="gpuID" id="gpuID" required>
        </p>
        <p>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" required>
        </p>
        <p>
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" required>
        </p>
        <p>
            <input type="submit" name="insertNewSaleBtn" value="Record Sale">
        </p>
    </form>

    <!-- Sales Table -->
    <h3>Sales</h3>
    <table>
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>GPU ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $salesRecords = seeSalesRecords($pdo); 
            foreach ($salesRecords as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['saleID']); ?></td>
                    <td><?php echo htmlspecialchars($row['gpuID']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars(number_format((float)$row['total_price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                    <td>
                        <a href="delete.php?saleID=<?php echo htmlspecialchars($row['saleID']); ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <div>
        <a href="logout.php">Logout</a>
    </div>

</body>
</html>