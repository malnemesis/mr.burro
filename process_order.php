<?php 
	
	session_start();

	require "php/conexion.php";

	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/OAuth.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['order_info'])) {
			
			$values = "VALUES";
			
			$name 		= htmlentities($_POST['name']);
			$addr 		= htmlentities($_POST['addr']);
			$email 		= htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$phone 		= preg_replace("#[^0-9]#", "", $_POST['phone']);
			$food 		= htmlentities($_POST['food'], ENT_QUOTES, 'UTF-8');
			$price 		= ($_POST['price']);
			
			if($name != "" && $addr != "" && $email != "" && $phone != "" && $food != "" && $price != "") {
			
				$insert = $db->query("INSERT INTO basket(customer_name, contact_number, address, email, total, status, date_made) VALUES('".$name."', '".$phone."', '".$addr."', '".$email."', '".$price."', 'pending', NOW())");

				$id_usuario = mysqli_insert_id($db);

				if($insert) {
					
					$ins_id = $db->insert_id;
					
					$food_array = explode(",", $food);
				
					foreach($food_array as $key => $value) {
						
						if(trim($value) != "") {
							
							$exp = explode("-", $value);
							
							$values .= "('".$ins_id."', '".$exp[0]."', '".$exp[1]."'),";
							
						}
						
					}
					
					$values = rtrim($values, ",");
					
					$save_item = $db->query("INSERT INTO items(order_id, food, qty) ".$values." ");
					
					if($save_item) {
						
						$_SESSION['order_id'] = "ORD_".$ins_id;
						$_SESSION['name'] = $name;
					
						echo "success";

						$orders = $db->query("SELECT * FROM basket WHERE id='".$id_usuario."'");

						while ($row = $orders->fetch_assoc()) {
							$total = $row['total'];
							$phone = $row['contact_number'];
							$phone = substr($phone,1);
							$address = $row['address'];
						}
						
						date_default_timezone_set("America/Guayaquil");

						$mail = new PHPMailer\PHPMailer\PHPMailer();

						$mail->CharSet = 'UTF-8';

						$mail->isMail();

						$admin = 'wendynathliaortiz@gmail.com';

						$mail->setFrom($admin, 'Mr.Burro');
						$mail->addAddress($admin, 'CLIENTE');
						$mail->Subject = 'PEDIDO';
						$mail->msgHTML('    <div style="width:100%; position:relative; font-family:sans-serif; padding-bottom:40px">
						
						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
						
							<center>
							
							<img style="padding:20px; width:15%" src="https://www.superavitasesores.com.ec/mr.burro/img/icon-email.png">
				
							<h1 style="color:#000000">PEDIDO REALIZADO '."ORD_".$ins_id.'</h1>
				
							<hr style="border:1px solid #ccc; width:80%">
				
							<h1 style="color:black; padding:0 20px">Nombre: '.$name.'</h1>
							<h1 style="color:black; padding:0 20px">Descripción: '.$food.'</h1>
							<h1 style="color:black; padding:0 20px">Dirección: '.$address.'</h1>
							<h1 style="color:black; padding:0 20px">TOTAL: $ '.$total.'</h1>
				
							<a href="https://api.whatsapp.com/send?phone=+593'.$phone.'" target="_blank" style="text-decoration:none">
							<h1 style="line-height:60px; background:#0aa; width:60%; color:black">CONTACTO CLIENTE</h1>
							</a>
				
							<hr style="border:1px solid #ccc; width:80%">
							<h1 style="color:#000000">Por favor siempre pongase en contacto con su cliente por si existe cambios.</h1>
							</center>
				
						</div>
					</div>');

					$mail->Send();

					}
				}

			}else{	
				echo "Incomplete Form Data";	
			}
			
			
		}elseif(isset($_POST['item_id_qty']) && $_POST['item_id_qty'] != "") {
			
			$explode_var = explode("_", htmlentities($_POST['item_id_qty']));
			
			$item_to_adjust = $explode_var[1];
			$quantity = $explode_var[0];
			
			if ($quantity >= 100) { $quantity = 99; }
			if ($quantity < 1) { $quantity = 1; }
			if ($quantity == "") { $quantity = 1; }
			$i = 0;
			foreach ($_SESSION["cart_array"] as $each_item) { 
					  $i++;
					  while (list($key, $value) = each($each_item)) {
						  if ($key == "item_id" && $value == $item_to_adjust) {
							  // That item is in cart already so let's adjust its quantity using array_splice()
							  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
						  } // close if condition
					  } // close while loop
			}
			
			$sql = $db->query("SELECT * FROM food WHERE id='$item_to_adjust' LIMIT 1");
			while ($row = $sql->fetch_assoc()) {
				
				$price = $row['food_price'];
				
			}
			$pricetotal = $price * $quantity;
			
			echo number_format($pricetotal,2);
			
		}
		
	}
	
?>