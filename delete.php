<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 

    if (isset($_GET['gpuID'])) {
        $gpuID = $_GET['gpuID'];
        deleteGPU($pdo, $gpuID);
        header("Location: businessManagementpage.php");
    } elseif (isset($_GET['saleID'])) {
        $saleID = $_GET['saleID'];
        deleteSale($pdo, $saleID);
        header("Location: salespage.php");
    }
?>
