<?php 
	
	session_start();
	error_reporting(0);
	
	require "php/conexion.php";
	
?>

<?php 

	// el usuario intenta agregar algo al carrito desde la página del producto //
	if (isset($_GET['fid']) && isset($_GET['qty'])) {
		$fid = $_GET['fid'];
		$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
		$wasFound = false;
		$i = 0;
		// Si la variable de sesión del carrito no está establecida o la matriz del carrito está vacía
		if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
			// EJECUTAR SI EL CARRITO ESTÁ VACÍO O NO ESTÁ CONFIGURADO
			$_SESSION["cart_array"] = array(0 => array("item_id" => $fid, "quantity" => $qty));
		} else {
			
			$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
			
			// SI EL CARRITO TIENE AL MENOS UN ARTÍCULO
			foreach ($_SESSION["cart_array"] as $each_item) { 
				  $i++;
				  while (list($key, $value) = each($each_item)) {
					  if ($key == "item_id" && $value == $fid) {
						  // Ese artículo ya está en el carrito, así que ajustemos su cantidad usando array_splice ()
						  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $fid, "quantity" => $each_item['quantity'] + $qty)));
						  $wasFound = true;
					  } 
				  }
			   }
			   if ($wasFound == false) {
				   array_push($_SESSION["cart_array"], array("item_id" => $fid, "quantity" => $qty));
			   }
		}
		header("location: basket.php"); 
		exit();
	}
	
?>

<?php
 
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//       Section 2 (if user chooses to empty their shopping cart)
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
		unset($_SESSION["cart_array"]);
	}
	
?>



<?php 

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//       Section 4 (if user wants to remove an item from cart)
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
		// Access the array and run code to remove that array index
		$key_to_remove = $_POST['index_to_remove'];
		if (count($_SESSION["cart_array"]) <= 1) {
			unset($_SESSION["cart_array"]);
		} else {
			unset($_SESSION["cart_array"]["$key_to_remove"]);
			sort($_SESSION["cart_array"]);
		}
	}
	
?>

<?php 

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//       Section 5  (render the cart for the user to view on the page)
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$cartOutput = "";
	$cartTotal = "";
	$chkbtn = "";
	$empty_cart = "";
	$chkprice = "";
	$product_id_array = "";
	
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		
		$cartOutput = "<div class='alert alert-danger text-center ' role='alert'>
        Tu <i class='material-icons'>local_mall</i> está vacía
    </div>";
		
	}else{
		
		$cartOutput = " <thead>
                            <tr>
								<th></th>
								<th class='text-center'>Precio U</th>
								<th class='text-center'>Cant</th>
								<th class='text-center'>Valor</th>
                                <th></th>
                            </tr>
                        </thead>";
						
		$i = 0;
		
		foreach ($_SESSION["cart_array"] as $each_item) { 
			$item_id = $each_item['item_id'];
			$sql = $db->query("SELECT * FROM food WHERE id='$item_id' LIMIT 1");
			while ($row = $sql->fetch_assoc()) {
				
				$foodName = $row['food_name'];
				$price = $row['food_price'];
				
			}
			
			$pricetotal = $price * $each_item['quantity'];
			$cartTotal = number_format($pricetotal,2 )+ number_format($cartTotal,2 );
			// Dynamic Checkout Btn Assembly
			$x = $i + 1;
			
            $empty_cart = '
            <a href="basket.php?cmd=emptycart" type="button" class="col btn btn-danger btn-sm">vaciar</a>
            ';
			
			$keep = '
						<br>
			    		<div class="text-center">
							<a href="index.php" class="btn btn-primary btn-rounded btn-block btn-sm col"><i class="material-icons">home</i> SEGUIR COMPRANDO</a>
						</div>';

            $chkbtn = '
            <a href="" type="button" class="col btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="material-icons">local_offer</i> pedir</a>
            ';
		
			// Create the product array variable
			$product_id_array .= "$foodName-".$each_item['quantity'].", "; 
			
			$cartOutput .= '<form action="basket.php" method="POST">
            
            <tbody>
            <tr>
				<th class="text-secondary small">' . $foodName . '</th>
				<th class="text-secondary small text-center">' . $price . '</th>
				<td class="text-center text-secondary small">'.$each_item['quantity'].'</td>
				<td class="text-center text-secondary small">'.number_format($pricetotal,2 ).'</td>
                <td><button name="deleteBtn' . $item_id . '" onclick="return verify_choice();" type="submit" class="btn btn-sm btn-link p-0 float-right"><i
                class="material-icons">remove_circle</i></button><input name="index_to_remove" type="hidden" value="' . $i . '" /></td>
            </tr>
          
        </tbody>

			
			</form>';
			
			$chkfood = '<input type="hidden" id="chkfood" name="chkfood" value="'.$product_id_array.'" />';
			$i++; 
		}
		$chkprice .= '<input type="hidden" id="chkprice" name="chkprice" value="'.number_format($cartTotal,2).'" />';
        $cartTotal = 
        '<div class="card mb-4 border-0 shadow-sm border-top-dashed">
        <div class="card-body text-center">
            <p class="text-secondary my-1">TOTAL</p>
            <h3 class="mb-0">$ '.number_format($cartTotal,2).'</h3>
           
        </div>
    </div>'
        
        ;
		
	}
	
?>

<?php include "php/head.php"; ?>

<body>

    <?php include 'php/loader.php' ?>

    <?php include 'php/sidebar.php' ?>

    <div class="wrapper">

        <?php require "php/headerr.php"; ?>

        <div class="container">

            <div class="subtitle h6" onclick="remove_class()">
                <div class="d-inline-block">
                    <i class="material-icons">local_mall</i> <br>
                </div>
            </div>

            <div class="row onclick=" remove_class()"">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <table class="table table-sm table-borderless">

                                <?php echo $cartOutput; ?>

                            </table>

                            <?php echo $cartTotal; ?>

                            <div class="btn-group w-100" role="group">

                                <?php echo $empty_cart; ?>

                                <?php echo $chkbtn; ?>

                            </div>
                            <br>
                            <?php echo $keep; ?>
                        </li>


                    </ul>


                </div>


            </div>




        </div>




        <?php include 'php/footer.php'?>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="header-title mb-0 text-muted"><i class="material-icons">local_offer</i> COMPLETA TU
                        PEDIDO
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form method="POST" action="" onSubmit="validate_input(); return false">

                    <div class="modal-body text-center pr-4 pl-4">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group float-label">
                                    <input type="text" class="form-control" id="name" name="name" required="">
                                    <label class="form-control-label" >Nombre y Apellido</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group float-label">
                                    <input type="text" class="form-control" id="addr" name="addr" required="">
                                    <label class="form-control-label">Dirección (SECTOR / CALLE / NÚMERO)</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group float-label">
                                    <input type="email" class="form-control" id="email" name="email" required="">
                                    <label class="form-control-label">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group float-label">
                                    <input type="number" class="form-control" id="phone" name="phone" required="">
                                    <label class="form-control-label">Número Celular</label>
                                </div>
                            </div>

                            <?php echo $chkfood; ?>

                             <?php echo $chkprice; ?>


                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit"
                                class="btn btn-default btn-rounded btn-block col">realizar pedido <i
                                    class="material-icons">send</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

   
</body>

</html>

<script>
var input = document.getElementById('phone');
input.addEventListener('input', function() {
    if (this.value.length > 10)
        this.value = this.value.slice(0, 10);
})
</script>