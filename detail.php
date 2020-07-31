<?php 
	
	session_start();

	require "php/conexion.php";

	$name = "";
	$desc = "";
	$category = "";
	$price = "";
	$id = "";
	$qty= "";
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") {
			$fid = preg_replace("#[^0-9]#", "", $_GET['fid']);
			if($fid != "") {
				$get_detail = $db->query("SELECT * FROM food WHERE id='".$fid."' LIMIT 1");
				if($get_detail->num_rows) {
					while($row = $get_detail->fetch_assoc()) {
						$id = $row['id'];
						$name = $row['food_name'];
                        $desc = $row['food_description'];
                        $selec = $row['food_selec'];
                        $selec2 = $row['food_selec2'];
                        $slide1 = $row['food_slide1'];
                        $slide2 = $row['food_slide2'];
						$cat  = $row['food_category'];
						$price  = $row['food_price'];
					}
				}else{
					header("location: index.php");					
				}
			}
		}else{
			header("location: index.php");
		}
	}elseif($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {
			$id = preg_replace("#[^0-9]#", "", $_POST['fid']);
            $qty = preg_replace("#[^0-9]#", "", $_POST['amount']);
			header("location: basket.php?fid=".$id."&qty=".$qty."");
		}
	}
	
?>



<?php include 'php/head.php' ?>

<body>

    <?php include 'php/loader.php' ?>

    <div class="wrapper">

        <?php include 'php/headerr.php' ?>

        <div class="container">

            <!-- Swiper -->
            <div class="swiper-container product-details">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="<?php echo $slide1; ?>">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo $slide1; ?>">
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>

            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-rounded ml-2" data-toggle="modal"
                data-target="#share"><i class="material-icons mb-18 mr-2">share</i>compartir</a>

            <form method="POST" action="detail.php">

            <div class="badge badge-success float-right mt-1"><?php echo $cat; ?></div>

            <p class="text-dark mb-1 mt-2 h6 d-block"><?php echo $name; ?></p>

            <p class="text-secondary"><?php echo $desc; ?></p>


            <?php 
            
            $select = "";

            if ($name == "Burrito 1 Proteina") {
            
                $select .= "
                
            <div class='row mx-0 mb-4'>
                <div class='col-12 col-md-12 col-lg-12'>
                    <div class='custom-control custom-checkbox text-secondary'>
                        <input type='checkbox' class='custom-control-input one' id='lomo1'>
                        <label class='custom-control-label' for='lomo1'>LOMO</label>
                    </div>
                    <div class='custom-control custom-checkbox text-secondary'>
                        <input type='checkbox' class='custom-control-input one' id='pollo1'>
                        <label class='custom-control-label' for='pollo1'>POLLO</label>
                    </div>
                    <div class='custom-control custom-checkbox text-secondary'>
                        <input type='checkbox' class='custom-control-input one' id='chorizo1'>
                        <label class='custom-control-label' for='chorizo1'>CHORIZO</label>
                    </div>
                    <div class='custom-control custom-checkbox text-secondary'>
                        <input type='checkbox' class='custom-control-input one' id='tocino1'>
                        <label class='custom-control-label' for='tocino1'>TOCINO</label>
                    </div>
                </div>
            </div>
                
                ";

            }elseif ($name == "Burrito 2 Proteinas") {
                
                $select .= "
                
                <div class='row mx-0 mb-4'>
                    <div class='col-12 col-md-12 col-lg-12'>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input two' id='lomo2'>
                            <label class='custom-control-label' for='lomo2'>LOMO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input two' id='pollo2'>
                            <label class='custom-control-label' for='pollo2'>POLLO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input two' id='chorizo2'>
                            <label class='custom-control-label' for='chorizo2'>CHORIZO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input two' id='tocino2'>
                            <label class='custom-control-label' for='tocino2'>TOCINO</label>
                        </div>
                    </div>
                </div>
                    
                    ";
         

            }elseif ($name == "Burrito 3 Proteinas") {

                $select .= "
                
                <div class='row mx-0 mb-4'>
                    <div class='col-12 col-md-12 col-lg-12'>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input three' id='lomo'>
                            <label class='custom-control-label' for='lomo'>LOMO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input three' id='pollo'>
                            <label class='custom-control-label' for='pollo'>POLLO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input three' id='chorizo'>
                            <label class='custom-control-label' for='chorizo'>CHORIZO</label>
                        </div>
                        <div class='custom-control custom-checkbox text-secondary'>
                            <input type='checkbox' class='custom-control-input three' id='tocino'>
                            <label class='custom-control-label' for='tocino'>TOCINO</label>
                        </div>
                    </div>
                </div>
                    
                    ";
            }

            
            ?>

        <?php echo ($select) ?>

            <p class="text-secondary selec"><?php echo $selec; ?></p>
            <p class="text-secondary selec2"><?php echo $selec2; ?></p>

            <div class="row mb-4">
                <div class="col-auto align-self-center">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button onclick="subtract_price();" class="btn btn-danger px-1" type="button"><i
                                    class="material-icons">remove</i></button>
                        </div>
                        <input type="text" class="form-control w-35" readonly id="amount" name="amount" value="1">
                        <div class="input-group-append">
                            <button onclick="sum_price();" class="btn btn-primary px-1" type="button"><i
                                    class="material-icons">add</i></button>
                        </div>
                    </div>
                </div>

                <div class="col-auto align-self-center">
                <input type="hidden" name="fid" value="<?php echo $id; ?>">
                    <button type="submit" name="submit" class="btn btn-default shadow btn-rounded">agregar al pedido<i
                            class="material-icons md-18">local_mall</i></button>
                </div>
            </div>

            </form>


        </div>

        <?php include 'php/footer.php'?>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-end" role="document">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <h6 class="subtitle mt-0">Compartir con</h6>
                    <div class="row">
                        <div class="col-12">
                            <figure class="avatar avatar-50 border-0 mx-1">
                                <img src="img/facebook.png" alt="">
                            </figure>
                            <figure class="avatar avatar-50 border-0 mx-1">
                                <img src="img/whatsapp.png" alt="">
                            </figure>
                            <figure class="avatar avatar-50 border-0 mx-1">
                                <img src="img/twitter.png" alt="">
                            </figure>
                        </div>
                    </div>
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

    <script src="js/uncheck.js"></script>

    <!-- page level script -->
    <script>
    $(window).on('load', function() {
        var swiper = new Swiper('.product-details ', {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination'
            }
        });


    });

    function sum_price() {

        amount = $("#amount").val();
        toInt = parseInt(amount);
        toInt = toInt + 1;
        $("#amount").val(toInt);
        price = $("#price").html();
        total_price = price * toInt;
        $("#total_price").html(total_price);
    }

    function subtract_price() {

        amount = $("#amount").val();
        toInt = parseInt(amount);
        if (toInt == 1) {
            toInt = 1;
        } else {
            toInt = toInt - 1;
        }
        $("#amount").val(toInt);
        price = $("#price").html();
        total_price = price * toInt;
        $("#total_price").html(total_price);
    }
    </script>

</body>



</html>