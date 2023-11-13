<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/style2.css" rel="stylesheet">
    <link rel="icon" href="images/Logo_icon.png" type="image/x-icon">
    <title>Enhancement2</title>
</head>

<body>
    <?php include 'includes/header.inc'; ?>

    <section class="enhance2">
        <h1>Manager security</h1>
        <div>
            This enhancement adds security to the manager page, which cannot be accessed directly via a URL,
            by requiring a specific login and password for server-side validation and storing this data in a
            table. Additionally, the "Manager Log-in" page, which controls access to the manager web sites,
            will make use of the data that has been saved. There will be an additional "log-out" option if
            the user is "logged in" to the page.
        </div>
        <ul class="enhance2_1">
            <li>
                <ul>
                    <li><strong>Manager authentication</strong></li>
                    <li>Using "POST" function to acquire "manager" data</li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><strong>Manager Log-in page</strong></li>
                    <li>Check the database to see if the account exists</li>
                    <li>Deny access if username or password do not match</li>
                    <li>Direct to manager page if account is valid</li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><strong>Manager Log-out page</strong></li>
                    <li>Provide a "log-out" link on the manager page if "logged in"</li>
                </ul>
            </li>
        </ul>
    </section>

    <section class="enhance2">
        <h1>"Customers" data table</h1>
        <div>
            This enhancement makes use of our database to use a main foreign key to link the "orders" table
            with the "customers" table. By minimizing data duplication and making it easier to handle the
            expanding volume of client data, creating distinct tables for different types of data enhances
            flexibility and accuracy when entering data. Relational databases improve readability and
            usability as well, enabling programmers to run sophisticated queries.
        </div>
    </section>

    <section class="enhance2">
        <h1>"Product" data table</h1>
        <div>
            This enhancement will browse the "product" database for information, which will be displayed on
            the product page. This eliminates the need for repetitious code and simplifies the process of
            adding new products by simply entering obtained information into the database. This database
            proves usefulness to programmers, offering a time reduction for upcoming updates.
        </div>
    </section>

    <?php include 'includes/footer.inc'; ?>
</body>

</html>