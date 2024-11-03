<?php 
session_start();
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['registerBtn'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (!empty($username) && !empty($email) && !empty($password) && !empty($role)) {

        // checking for existing username in both users and admins tables
        $query = "SELECT username FROM users WHERE username = :username
                  UNION
                  SELECT username FROM admins WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            echo " Username already exists. Please choose a different username.";
        } else {
            // no duplicates found, proceed with normal registration
            if ($role === 'admin') {
                $query = insertNewAdmin($pdo, $username, $email, $password);
            } else {
                $query = insertNewUser($pdo, $username, $email, $password);
            }

            if ($query) {
                header("Location: ../sql/index.php"); 
                exit;
            } else {
                echo "Failed to register.";
            }
        }
    } else {
        echo "All fields are required.";
    }
}
if (isset($_POST['loginBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Check if regular user in users table
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        session_start(); // Start the session
        $_SESSION['username'] = $username; 
        
        // Redirect regular user to sales page
        header("Location: ../sql/salespage.php");
        exit;
    }
    
    // Check admin in admins table if not found in users
    $query = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        session_start(); // Start the session
        $_SESSION['username'] = $username; // Store the username in the session
        
        // Redirect admin to business management page
        header("Location: ../sql/businessManagementpage.php");
        exit;
    }

    // If no user is found, display an invalid credentials message
    echo "Invalid credentials.";
}



// insert GPU
if (isset($_POST['insertNewGPUBtn'])) {
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $in_stock = trim($_POST['in_stock']);
    $addedby = $_SESSION['username']; // Get the username of the logged-in user

    if (!empty($brand) && !empty($model) && !empty($price) && isset($in_stock)) {
        $query = insertIntoGPURecords($pdo, $brand, $model, $price, $in_stock, $addedby);

        if ($query) {
            header("Location: ../sql/businessManagementpage.php");
            exit;
        } else {
            echo "Failed to insert GPU record.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}

// edit GPU
if (isset($_POST['editGPUBtn'])) {
    $gpuID = $_GET['gpuID'];
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $in_stock = trim($_POST['in_stock']);
    $updatedby = $_SESSION['username']; 

    if (!empty($gpuID) && !empty($brand) && !empty($model) && !empty($price) && isset($in_stock)) {
        $query = updateGPU($pdo, $gpuID, $brand, $model, $price, $in_stock, $updatedby);

        if ($query) {
            header("Location: ../sql/businessManagementpage.php");
            exit;
        } else {
            echo "Failed to update GPU record.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}



// insert sale records
if (isset($_POST['insertNewSaleBtn'])) {
    $gpuID = trim($_POST['gpuID']);
    $quantity = trim($_POST['quantity']);
    $total_price = trim($_POST['total_price']);

    if (!empty($gpuID) && !empty($quantity) && !empty($total_price)) {
        $query = insertIntoSalesRecords($pdo, $gpuID, $quantity, $total_price);

        if ($query) {
            header("Location: ../sql/salespage.php");
            exit;
        } else {
            echo "Failed to record the sale.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}
