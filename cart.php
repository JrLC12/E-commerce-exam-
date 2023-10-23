<?php
include("connection.php");
if(isset($_POST["update"])){
    $id = $_GET["order_id"];
    $get_record = mysqli_query($connect,"SELECT * FROM order_table WHERE order_id = '$id'");
    $get_record_num = mysqli_num_rows($get_record);
    if($get_record_num > 0){
		while($row = mysqli_fetch_assoc($get_record)){
		$db_prod_id = $row["order_id"];
		$db_prod_name = $row["product_name"];
		$db_prod_image = $row["product_image"];
		$db_prod_size = $row["product_size"];
		$db_quantity = $row["quantity"];
		$db_prod_price = $row["price"];
		
		}
		
		
		$total_new = $_POST['updated_quantity'] * $db_prod_price;
			if($_POST["updated_quantity"] <= 0 OR $_POST["updated_quantity"] >= 101){
				echo "<script>alert('Quantity must be between 1-100'); </script>";
			}
		
		
			else{
				
				$query = "UPDATE order_table SET  quantity = '".$_POST['updated_quantity']."', total= '".$total_new ."' WHERE order_id = $id ";
				$sql = mysqli_query($connect,$query);
					if(!$sql){
						echo "<script>alert('Updating data failed.'); </script>";
					}
					else{
						header("location:cart.php");
					}
			}
}

               

		$result = mysqli_query($connect,"SELECT SUM(total) AS sum FROM order_table");
		$row = mysqli_fetch_array($result);
		$over_all = $row['sum'];
}
?>
<!DOCTYPE html>
<html  lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/index.js"></script>
    <link rel="stylesheet" href="assets/img/">
    <title>E-commerce (CART)</title>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="index.php" id="logos">LOGO</a>
        <a href="index.php">Home</a>
        <a href="#Products">Products</a>
        <a href="#About">About</a>
        <a href="cart.php" class="active">
            <i class="fa fa-shopping-cart"></i>
        </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="container-fluid-own">
        <table>
            <tr class="trtop">
                <th colspan="2">PRODUCT</th>
                <th>PRODUCT SIZE </th>
                <th>QUANTITY</th>
                <th>PRICE </th>
                <th>TOTAL </th>
                <th colspan="2">ACTION </th>
            </tr>
            <?php

            $sql_new = "SELECT * From order_table";
            $num_per_page = 5;
            $result = mysqli_query($connect, $sql_new);
            $number_of_results = mysqli_num_rows($result);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            $start_from = ($page - 1) * $num_per_page;
            $number_of_pages = ceil($number_of_results / $num_per_page);
            $sql = "SELECT *FROM order_table LIMIT $start_from,$num_per_page";
            $result = mysqli_query($connect, $sql);
            $number_of_results = mysqli_num_rows($result);


            while ($row = mysqli_fetch_array($result)) {
                if (isset($_POST["delete"])) {
                    $delete_order_id = $_GET["order_id"];
                    mysqli_query($connect, "DELETE FROM order_table WHERE order_id = '$delete_order_id' ");
                    header("location:cart.php");
                }
                
                ?>

                <tr>
                    <td>
                        <?php echo "$row[product_name]"; ?>
                    </td>
                    <td><img class="prod-img" src="<?php echo "$row[product_image]"; ?>"></td>
                    <td>
                        <?php echo "$row[product_size]"; ?>
                    </td>
                    <td>
                        <?php


                        ?>
                        <form action="cart.php?order_id=<?php echo "$row[order_id]"; ?>" method="POST">
                            <span class="down" onClick="decreaseCount(event, this)">-</span>
                            <input class="quantity_value" type="text" name="updated_quantity"
                                value=' <?php echo "$row[quantity]"; ?>'>
                            <span class="up" onClick="increaseCount(event, this)">+</span>

                    </td>
                    <td>
                        <?php echo "₱$row[price].00"; ?>
                    </td>
                    <td>₱
                        <?php echo number_format($row["total"], 2); ?>
                    </td>
                    <td>
                        <div class="update-div"> <!-- EDIT DIV -->
                            <button type="submit" name="update">Update</button>
                        </div> <!-- EDIT DIV END -->

                    </td>
                    <td>
                        <div class="delete-div"> <!-- delete DIV -->
                            <button type="submit" name="delete">Delete</button>
                        </div> <!-- delete DIV END -->
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>

            <tr>
                <?php

                $over_all_total_result = mysqli_query($connect, "SELECT SUM(total) AS sum from order_table");
                $row = mysqli_fetch_array($over_all_total_result);
                $over_all = $row['sum'];
                ?>
                <td colspan="5">
                    total
                </td>
                <td>₱
                    <?php echo number_format($over_all, 2); ?>
                </td>
                <td colspan="2"><button type="submit" name="checkout" class="checkout" id="myBtn1">CHECKOUT</td>
            </tr>
        </table>

        <div class="pagination-div2cart ">
            <?php
            if ($page > 1) {
                echo "<a href='cart.php?page=" . ($page - 1) . "' class='previous'>Previous</a>";
            }
            for ($i = 1; $i <= $number_of_pages; $i++) {
                echo '<a class="" href="cart.php?page=' . $i . '">&nbsp' . $i . '&nbsp</a> ';
            }
            $i = $i - 1;
            if ($i > $page) {
                echo "<a href='cart.php?page=" . ($page + 1) . "' class='next'>Next</a>";
            }
            ?>
        </div>
    </div>
    
    <section style="position:relative;">
      <footer class="top">
        <img src="logo.svg" />
        <div class="links">
          <div>
            <h2>Platform</h2>
            <a>Directus Core</a>
            <a>Open Data Platform</a>
            <a>Feature List</a>
            <a>Road Map</a>
            <a>Marketplace</a>
          </div>
          <div>
            <h2>Cloud</h2>
            <a>Dashboard</a>
            <a>Register</a>
            <a>Pricing</a>
            <a>System Status</a>
            <a>Partner Program</a>
          </div>
        </div>
      </footer>
      <footer class="bottom">
        <div class="legal">
          <span> © 2023 All rights reserved </span>
          <a> License </a>
          <a> Terms </a>
          <a> Privacy </a>
        </div>
        <div class="links">
          <a class="fa-brands fa-github"></a>
          <a class="fa-brands fa-linkedin"></a>
          <a class="fa-brands fa-docker"></a>
        </div>
      </footer>
    </section>
    <script type="text/javascript">
        function increaseCount(a, b) {
            var input = b.previousElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
        }
        function decreaseCount(a, b) {
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 0) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
            }
        }
    </script>
</body>

</html>