<?php
session_start();
if (!isset($_SESSION['authenticated']) || (!$_SESSION['authenticated'])) {
    header("Location: ./log_in.php?error_msg=Unauthenticated");
}


require_once("./support_functions.php");

    $cusname = ndv("cusname", "");
    $product = ndv("product", "");
    $totalcost = ndv("totalcost", "");
    $status = ndv("status", "");
    $query = "
    select * from s104181721_db.orders
    inner join s104181721_db.products
    on s104181721_db.orders.Bike_Id = s104181721_db.products.Bike_Id";

// checks whether or not there are two "where clauses" in a SQL query
$addand = false;

    if($cusname != ""){
        $query .= " where (s104181721_db.orders.First_Name like '%$cusname%' or s104181721_db.orders.Last_Name like '%$cusname%')";
        $addand = true;
    }

    if($status != ""){
        if($addand)
            $query .= " and";
        else
            $query .= " where";
        $query .= " s104181721_db.orders.ord_status = '$status'";
        $addand = true;
    }

    if($product != ""){
        if($addand)
            $query .= " and";
        else
            $query .= " where";
        $query .= " s104181721_db.orders.Bike_Id = $product";
    }
    $query .= " order by s104181721_db.orders.ord_cost $totalcost";

    $orders = $conn->query($query);
    $bike = $conn->query("select * from s104181721_db.products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/style2.css" rel="stylesheet">
    <link rel="icon" href="images/Logo_icon.png" type="image/x-icon">
    <title>Manager</title>
</head>

<body>
    <?php include 'includes/header.inc'; ?>


<h1 class="manager_intro">Manager Page</h1>
<form action="manager.php" method="GET">
    <div class="sort_table">
        <div class="sort" style="display: flex;flex-direction: column;">
            <label for="cusname">Customer name:</label>
            <input type="text" id="cusname" name="cusname" placeholder="Enter customer name" value="<?= $cusname ?>">
        </div>

        <div class="sort">
            <label for="product">Product:</label>
            <select name="product" id="product">
                <option value="" selected>ALL</option>
                <?php while ($row = mysqli_fetch_assoc($bike)) { ?>
                    <option value="<?php echo $row['Bike_Id'] ?>" <?php echo $row['Bike_Id'] === $product ? 'selected' : '' ?>>
                        <?php echo $row['Pd_Name'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="sort">
            <label for="totalcost">Total cost:</label>
            <select name="totalcost" id="totalcost">
                <option value="DESC" <?php echo $totalcost === "DESC" ? 'selected' : '' ?>>Descending</option>
                <option value="ASC" <?php echo $totalcost === "ASC" ? 'selected' : '' ?>>Ascending</option>
            </select>

        </div>

        <div class="sort">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="" selected>ALL</option>
                <option value="PENDING" <?php echo $status === 'PENDING' ? 'selected' : '' ?>>PENDING</option>
                <option value="FULFILLED" <?php echo $status === 'FULFILLED' ? 'selected' : '' ?>>FULFILLED</option>
                <option value="PAID" <?php echo $status === 'PAID' ? 'selected' : '' ?>>PAID</option>
                <option value="ARCHIEVED" <?php echo $status === 'ARCHIEVED' ? 'selected' : '' ?>>ARCHIEVED</option>
            </select>
        </div>

        <div class="search">
            <input class="search" type="submit" value="Search">
        </div>
    </div>

    <div class="ordtable">
        <?php if($orders && $orders->num_rows == 0){ ?>
            <p class="notFoundMsg">No entries were found.</p>
        <?php } else { ?>
            <table id="ordertable">
                <tr>
                    <th>Order ID</th>
                    <th>Order date</th>
                    <th>Customer name</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Total cost</th>
                </tr>
                    <?php while ($row = mysqli_fetch_assoc($orders)){?>
                    <tr>
                        <td><?php echo $row['ord_id']; ?></td>
                        <td><?php echo $row['ord_time']; ?></td>
                        <td><?php echo $row['First_Name'] . " " . $row['Last_Name']; ?></td>
                        <td><?php echo $row['Pd_Name']; ?></td>
                        <td><?php echo $row['ord_status']; ?></td>
                        <td><?php echo $row['ord_cost']; ?></td>
                    </tr>
                    <?php } ?>
            </table>
        <?php } ?>
    </div>
</form>

<form method="POST" action="edit_order.php">
    <!-- change order status -->
    <div class="updatesta">
        <label for="orderid">Order ID:</label>
        <input type="text" placeholder="Enter Order ID" id="orderid" name="orderid">
        <label for="status">Change status</label>
        <select name="status" id="status">
            <option value="PENDING" <?php echo $ord['ord_status'] = 'PENDING' ? 'selected' : '' ?>>PENDING</option>
            <option value="FULFILLED" <?php echo $ord['ord_status'] = 'FULFILLED' ? 'selected' : '' ?>>FULFILLED</option>
            <option value="PAID" <?php echo $ord['ord_status'] = 'PAID' ? 'selected' : '' ?>>PAID</option>
            <option value="ARCHIVED" <?php echo $ord['ord_status'] = 'ARCHIVED' ? 'selected' : '' ?>>ARCHIVED</option>
        </select>
        <input type="submit" value="Change">
    </div>
</form>

<form method="POST" action="delete_order.php">
    <div class="deletepending">
        <label for="orderid">Order ID:</label>
        <input type="text" name="orderid" placeholder="Enter Order ID" id="orderid">
        <input type="submit" value="Delete">
    </div>
</form>

<div class="logout_btn">
    <a href="log_out.php">Logout</a>

</div>

    <?php include 'includes/footer.inc'; ?>
</body>

</html>