<?php

    require_once("./support_functions.php");
        // Checkign submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // From the form, get order id
            $order_id = $_POST["orderid"];

            // Checking the pending status of the order
            $checkpending = "SELECT * FROM s104181721_db.orders WHERE orders.ord_id = '$order_id' AND orders.ord_status = 'PENDING'";
            $result = $conn->query($checkpending);

            if ($result->num_rows > 0) {
                // Delete order
                $sql = "DELETE FROM s104181721_db.orders WHERE orders.ord_id = '$order_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Order cancelled successfully";
                } else {
                    echo "Error cancelling order: " . $conn->error;
                }
            } else {
                echo "Order cannot be cancelled. It may already be cancelled or delivered.";
            }
        }
    ?>