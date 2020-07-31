<?php 
	
	session_start();
	error_reporting(0);
	
	$order_id = $_SESSION['order_id'];
	$name = $_SESSION['name'];
	
	unset($_SESSION['order_id']);
	unset($_SESSION['name']);
	unset($_SESSION['cart_array']);
	
?>



<?php include 'php/head.php' ?>

<body>

<?php include 'php/loader.php' ?>

<?php include 'php/sidebar.php' ?>


    <div class="wrapper">
 
    <?php include 'php/header.php' ?>

        <div class="container">

            <div class="row">
                <div class="col-12 text-center">
                    <br>
                    <img src="img/thankyou-payment.png" class="mt-5 mw-100">
                    <h1 class="my-4">PEDIDO EXITOSO!</h1>
                    <h5><?php echo $order_id ?></h5>
                    <p class="text-secondary">Su pedido ha sido procesado<br>y será entregado pronto.</p>
                    <br>
                </div>
            </div>
        </div>

        <?php include 'php/footer.php'?>
    
    </div>
    <!-- jquery, popper and bootstrap js -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!-- swiper js -->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- nouislider js -->
    <script src="vendor/nouislider/nouislider.min.js"></script>

    <!-- chosen multiselect js -->
    <script src="vendor/chosen_v1.8.7/chosen.jquery.min.js"></script>

    <!-- template custom js -->
    <script src="js/main.js"></script>

    <script>
        $(window).on('load', function(){
            setTimeout(function(){
                window.open("index.php", "_self");    
            }, 5000)
            
        })
    </script>

   
</body>

</html>
