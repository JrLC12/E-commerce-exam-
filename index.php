<?php
include("connection.php");

if (!isset($_POST["add_to_cart"])) {
    $id = 0;
} else {
    $id = $_GET["id"];
    $atc_product_name = $_POST["hidden_name"];
    $atc_product_image = $_POST["hidden_image"];
    $atc_product_size = $_POST["hidden_size"];
    $atc_product_quantity = $_POST["quantity"];
    $atc_product_price = $_POST["hidden_price"];
    $total = ($atc_product_quantity * $atc_product_price);
    $query = "INSERT INTO order_table(product_name,product_image,product_size,quantity,price,total) 
	VALUES('$atc_product_name','$atc_product_image','$atc_product_size',$atc_product_quantity,$atc_product_price,$total)";
    if (mysqli_query($connect, $query)) {
        echo "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script type='text/javascript'>
        
        $(function(){
        Swal.fire({
            icon: 'success',
            title: 'Added successufully',
            confirmButtonText: 'Okay ',
            color:'orange',
            backdrop: 'transparent'
            }).then((result) => {
                if (result.isConfirmed) {
            window.location.replace('index.php');
            }
})
            
            });
        </script>
        ";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/index.js"></script>
    <link rel="stylesheet" href="assets/img/">
    <title>E-commerce</title>
</head>

<body>


    <div class="topnav" id="myTopnav">
        <a href="index.php" id="logos">LOGO</a>

        <a href="#top" id="home_nav">Home</a>
        <a href="#product" id="product_nav" >Products</a>
        <a href="#About" id="about_nav" >About</a>
        <a href="cart.php" id="cart_nav" >
            <i class="fa fa-shopping-cart"></i>
        </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
 <main>
            <img src="assets\img\pizzabg.jpg" alt="">
        </main>
    <div class="container-fluid">

       

        <div id="sidebar">
            <form action="index.php" method="POST">
            <button type="submit" name="large"><span>Large </span> </button >
            <button type="submit" name="medium"><span>Medium</span></button >
            <button type="submit" name="small"><span>Small</span></button >
            <button type="submit" name="pizza"><span>Pizza</span></button >
            </form>
        </div>
        <div id="sidebar2">
            <form action="index.php" method="POST">
            <button type="submit" name="large"><span>Large </span> </button >
            <button type="submit" name="medium"><span>Medium</span></button >
            <button type="submit" name="small"><span>Small</span></button >
            <button type="submit" name="pizza"><span>Pizza</span></button >
            </form>
        </div>
        

        <?php

        $sql_new = "SELECT * FROM cravings_table";
        $num_per_page = 8;
        $result = mysqli_query($connect, $sql_new);
        $number_of_results = mysqli_num_rows($result);

        ?>
        <div class="container"> <!--container START -->
            <div class="row"><!--row START -->
                <?php
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $start_from = ($page - 1) * $num_per_page;
                $number_of_pages = ceil($number_of_results / $num_per_page);
                $large = 'Large';
                if(isset($_POST['large'])){
                    $product_size = "Large";
                    $sql = "SELECT * From cravings_table WHERE product_size = '$product_size' LIMIT $start_from,$num_per_page";                                                                                          
                }
                else if(isset($_POST['medium'])){
                    $product_size = "Medium";
                    $sql = "SELECT * From cravings_table WHERE product_size = '$product_size' LIMIT $start_from,$num_per_page";
                }
                else if(isset($_POST['small'])){
                    $product_size = "Small";
                    $sql = "SELECT * From cravings_table WHERE product_size = '$product_size' LIMIT $start_from,$num_per_page";
                }
                else if(isset($_POST['pizza'])){
                    $product_size = "Regular";
                    $sql = "SELECT * From cravings_table WHERE product_size = '$product_size' LIMIT $start_from,$num_per_page";
                }
                if(!isset($_POST["large"]) && !isset($_POST["medium"]) && !isset($_POST["small"]) && !isset($_POST["pizza"])){
                    $sql = "SELECT * From cravings_table LIMIT $start_from,$num_per_page";

                }
               
                $result = mysqli_query($connect, $sql);
                $get_total_of_records = mysqli_num_rows($result);
                if ($get_total_of_records > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form id="product" method="POST" action="index.php?id=<?php echo"$row[id]";?>">
                        <div class="col-sm"> <!--COL SM START -->
                            <div class="card"> <!--CARD START -->
                                <div class="card-img"><img class="prod_img" src="<?php echo "$row[product_image]"; ?>">
                                </div>
                                <div class="card-info">
                                    <p class="text-title">
                                        <?php echo "$row[product_name]"; ?>
                                    </p>
                                    <p class="text-body">
                                        <?php echo "$row[product_size]"; ?>
                                        <br>
                                    <div style="margin-top:-10%;display:flex;justify-content:center;">
                                        <span class="down" onClick="decreaseCount(event, this)">-</span>
                                        <input class="quantity_value" type="text" name="quantity" value='1'>
                                        <span class="up" onClick="increaseCount(event, this)">+</span>
                                        <input type="hidden" name="hidden_image" value="<?php echo "$row[product_image]"; ?>" />
                                        <input type="hidden" name="hidden_name" value="<?php echo "$row[product_name]"; ?>" />
                                        <input type="hidden" name="hidden_size" value="<?php echo "$row[product_size]"; ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo "$row[price]"; ?>" />
                                    </div>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <span class="text-title">₱
                                        <?php echo "$row[price]"; ?>.00
                                    </span>
                                    <div class="card-button"><button
                                            style="outline:none;border:none;background:transparent;cursor:pointer;padding-top:5%;"
                                            type="submit" name="add_to_cart">
                                            <svg class="svg-icon" viewBox="0 0 20 20">
                                                <path
                                                    d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z">
                                                </path>
                                                <path
                                                    d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z">
                                                </path>
                                                <path
                                                    d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z">
                                                </path>
                                            </svg></button>
                                    </div>
                                </div>
                            </div><!--CARD END -->
                        </div> <!--COL SM END -->
                        </form>
                    <?php }
                } ?>
            </div><!--row END -->
           

           

        </div><!--CONTAINER END -->
        <div class="pagination-div2">
                <?php
                if ($page > 1) {
                    echo "<a href='index.php?page=" . ($page - 1) . "' class='previous'>Previous</a>";
                }
                for ($i = 1; $i <= $number_of_pages; $i++) {
                    echo '<a class="" href="index.php?page=' . $i . '">&nbsp' . $i . '&nbsp</a> ';
                }
                $i = $i - 1;
                if ($i > $page) {
                    echo "<a href='index.php?page=" . ($page + 1) . "' class='next'>Next</a>";
                }
                ?>
            </div>

    </div>
    <section>
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