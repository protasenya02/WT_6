<?php
    session_start();
    require("includes/connection.php");
    addProductToCart();
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
<section class="products">
    <div class="container">
        <div class="products_list">
            <?php outputProductList();?>
       </div>
    </div>
</section>
</body>
</html>