<?php

require_once("support_functions.php");

$products = $conn->query("select * from s104181721_db.products");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link rel="icon" href="images/LOGO_ICON.png" type="image/x-icon">
    <title>Product</title>
</head>

<body>
    <?php include 'includes/header.inc'; ?>

    <section class="product_intro">
        <div class="product_box_intro">
            <h1>Explore our new release. </h1>
        </div>
        <div class="bike_table">

            <div class="shop_intro">
                <h2>Explore the concept of extraodinary engineering</h2>
                <p>HDAK is a premier motorcycle shop that specializes in providing top-of-the-line motorcycles and accessories to riders of all levels. With a deep passion for motorcycles and a commitment to customer satisfaction, HDAK has become a go-to destination for motorcycle enthusiasts looking for quality products and expert advice. Whether you're a seasoned rider or a beginner just starting out, HDAK has everything you need to make your riding experience safe, comfortable, and unforgettable. Come visit us today and discover the thrill of the open road!</p>
            </div>
        </div>
    </section>
    <section>
        <div class="product_box_intro">
            <h1>Discover our products.</h1>
        </div>
        <div class="bike_outer">
            <?php while ($row = mysqli_fetch_assoc($products)) { ?>
                <section class="bikes_card">
                    <img class="bikes_images" src="<?php echo $row['Pd_Image'] ?> " alt="<?php echo $row['Pd_Name'] ?>">
                    <div class="product_desc">
                        <h3>
                            <?php echo $row['Pd_Name'] ?>
                        </h3>
                        <p>
                            <?php echo $row['Pd_Description'] ?>
                        </p>
                        <p>
                            <?php echo $row['Pd_Overview'] ?>
                        </p>
                        <div class="stat_overview">
                            <table class="product_stat">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <?php echo $row['Pd_Name'] ?>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Product year
                                        </td>
                                        <td>
                                            <?php echo $row['Pd_Year'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Color
                                        </td>
                                        <td>
                                            <?php echo $row['Pd_Colour'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Riding position
                                        </td>
                                        <td>
                                            <?php echo $row['Pd_Riding_position'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Foot control
                                        </td>
                                        <td>
                                            <?php echo $row['Pd_Foot_Control'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Safety enhancement
                                        </td>
                                        <td>
                                            <?php echo $row['Pd_Rider_safety_enhancements'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Source
                                        </td>
                                        <td>
                                            <a href="<?php echo $row['Image_Source'] ?>">
                                                Harley-Davidson
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <a class="purchase_btn" href='payment.php?Bike_Id=<?php echo $row['Bike_Id'] ?>'>
                            Purchase
                        </a>

                    </div>
                </section>
            <?php    } ?>
        </div>
    </section>

    <?php include 'includes/footer.inc'; ?>
</body>

</html>