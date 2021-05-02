<?php
    session_start();
    require("includes/connection.php");
    updateCart();
    submitCart();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Boutique</title>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header_inner">
            <div class="header_logo">Designer boutique</div>
            <nav >
                <ul class="header_nav">
                    <li><a class="nav_link" href="index.php">Shop</a></li>
                    <li><a class="nav_link" href="cart.php">Cart</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<section class="cart">
    <div class="container">
        <h2 class="cart_title">Product cart</h2>
        <form method="post" action="">
        <table class="cart_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Items Price</th>
                </tr>
            </thead>
            <tbody>
            <?php outputCart(); ?>
            </tbody>
        </table>
            <div class="cart_buttons">
                <button id="update_cart" type="submit" name="update">Update cart</button>
                <button id="submit_cart" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</section>
</body>
</html>