<?php 
    require_once("./support_functions.php");

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $conn->query("update s104181721_db.orders set ord_status = '" . $_POST['status'] . "' where ord_id = " . $_POST['orderid']);
        header('Location: manager.php');
        exit;
    }

    // If the order is not set, cancel
    if(!isset($_GET['orderid'])){
        header('Location: manager.php');
        exit;
    }

    $ordid = $_GET['orderid'];
    $ord = mysqli_fetch_assoc($conn->query("select * from s104181721_db.orders where ord_id = " . $ordid));
?>