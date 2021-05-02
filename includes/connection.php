<?php
require_once("constants.php");

function connectBD($query) {

    // подключение к базе данных
    $mysqli = @new mysqli(HOST, USER, PASS, DB);
    // проверка соединения
    if ($mysqli->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
    }
    // установка кодировки
    $mysqli->set_charset('utf8');

    // запрос к БД
    $result = $mysqli->query($query);

    return $result;
}

function outputProductList() {

    $query = "SELECT * FROM clothes";
    // подключение к БД
    $result = connectBD($query);

    if ($result->num_rows > 0) {

        // вывод каждой строки из таблицы
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product_item">
                <img src = <?= $row['image_link']?>>
                 <div class="product_list">
                    <h3><?=$row['name']?></h3>
                    <span class="price"><?=$row['price']?> BYN</span>
                    <a href="index.php?action=add&id=<?php echo $row['id'] ?>" class="add_button">Add to cart</a>
                 </div>
             </div>
            <?php
        }
    }
}

function addProductToCart() {

    if (isset($_GET['action']) && $_GET['action'] == "add") {

        // получение id выбранного товара
        $id = intval($_GET['id']);

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {

            // запрос на получение выбранного товара
            $query = "SELECT * FROM clothes WHERE id=$id";
            // подключение к бд
            $result = connectBD($query);

            if ($result->num_rows > 0) {

                // извлечение ассоциативного массива
                $row = $result->fetch_assoc();

                // добавление в сессию
                $_SESSION['cart'][$row['id']] = array(
                    "quantity" => 1,
                    "price" => $row['price']
                );
            } else {
                echo "This product id it's invalid!";
            }
        }
    }
}

function outputCart() {

    $query = "SELECT * FROM clothes WHERE id IN (";

    foreach($_SESSION['cart'] as $id => $value) {
        $query.=$id.",";
    }

    $query = substr($query, 0, -1).") ORDER BY name ASC";
    // подключение к БД
    $result = connectBD($query);
    $total_price=0;

    while ($row = $result->fetch_assoc()) {
        // подсчет общей цены одного товара
        $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price'];
        $total_price+=$subtotal;
        ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><input type="text" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td>
            <td><?php echo $row['price'] ?>$</td>
            <td><?php echo $_SESSION['cart'][$row['id']]['quantity']*$row['price'] ?>$</td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td class="total_price" colspan="4">Total Price: <?php echo $total_price ?>$</td>
    </tr>
    <?php
}

function updateCart() {

    if(isset($_POST['update'])){

        foreach($_POST['quantity'] as $key => $value) {
            if($value==0) {
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['quantity']=$value;
            }
        }
    }
}

function submitCart() {
    if(isset($_POST['submit'])){
        unset($_SESSION['cart']);
    }
}


