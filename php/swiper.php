<?php

	session_start();
	
	require "php/conexion.php";

    $promos = "";
    $burritos = "";
    $quesadillas = "";
    $especialidades = "";
    $chimichangas = "";
    $nachos = "";
    $extras = "";
    $bandejas = "";
    $papas = "";
    $micheladas = "";


	$get_recent = $db->query("SELECT * FROM food");

	if($get_recent->num_rows) {
		while($row = $get_recent->fetch_assoc()) {
			if($row['food_category'] == "PROMO") {

                $promos .= "
                <a href='detail.php?fid=".$row['id']."'>
                            <div class='swiper-slide'>
                                <div class='card shadow-sm border-0'>
                                    <div class='card-body'>
                                        <div class='row no-gutters h-100'>
                                            <img src='".$row['food_img']."' class='small-slide-right'>
                                            <div class='col-8'>
                                                <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                                                <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                                                </h5></a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                         ";

			

			}elseif ($row['food_category'] == "BURRITOS") {

                $burritos .=	"   
                
                <a href='detail.php?fid=".$row['id']."'>
                <div class='swiper-slide'>
                    <div class='card shadow-sm border-0'>
                        <div class='card-body'>
                            <div class='row no-gutters h-100'>
                                <img src='".$row['food_img']."' class='small-slide-right'>
                                <div class='col-8'>
                                    <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                                    <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                                    </h5></a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        ";

    }elseif ($row['food_category'] == "QUESADILLAS") {

        $quesadillas .=	"   
        
        <a href='detail.php?fid=".$row['id']."'>
        <div class='swiper-slide'>
            <div class='card shadow-sm border-0'>
                <div class='card-body'>
                    <div class='row no-gutters h-100'>
                        <img src='".$row['food_img']."' class='small-slide-right'>
                        <div class='col-8'>
                            <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                            <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                            </h5></a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
";

}elseif ($row['food_category'] == "CHIMICHANGAS") {

    $chimichangas .=	"   
    
    <a href='detail.php?fid=".$row['id']."'>
    <div class='swiper-slide'>
        <div class='card shadow-sm border-0'>
            <div class='card-body'>
                <div class='row no-gutters h-100'>
                    <img src='".$row['food_img']."' class='small-slide-right'>
                    <div class='col-8'>
                        <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                        <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                        </h5></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
";

}elseif ($row['food_category'] == "NACHOS") {

    $nachos .=	"   
    
    <a href='detail.php?fid=".$row['id']."'>
    <div class='swiper-slide'>
        <div class='card shadow-sm border-0'>
            <div class='card-body'>
                <div class='row no-gutters h-100'>
                    <img src='".$row['food_img']."' class='small-slide-right'>
                    <div class='col-8'>
                        <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                        <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                        </h5></a>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
";

                
            }elseif ($row['food_category'] == "ESPECIALIDADES") {

                $especialidades .=	"   
                
                <a href='detail.php?fid=".$row['id']."'>
                <div class='swiper-slide'>
                    <div class='card shadow-sm border-0'>
                        <div class='card-body'>
                            <div class='row no-gutters h-100'>
                                <img src='".$row['food_img']."' class='small-slide-right'>
                                <div class='col-8'>
                                    <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                                    <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                                    </h5></a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            
        ";


    }elseif ($row['food_category'] == "EXTRAS") {

        $extras .=	"   
        
        <a href='detail.php?fid=".$row['id']."'>
        <div class='swiper-slide'>
            <div class='card shadow-sm border-0'>
                <div class='card-body'>
                    <div class='row no-gutters h-100'>
                        <img src='".$row['food_img']."' class='small-slide-right'>
                        <div class='col-8'>
                            <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                            <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                            </h5></a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    
";

}elseif ($row['food_category'] == "BANDEJAS") {

    $bandejas .=	"   
    
    <a href='detail.php?fid=".$row['id']."'>
    <div class='swiper-slide'>
        <div class='card shadow-sm border-0'>
            <div class='card-body'>
                <div class='row no-gutters h-100'>
                    <img src='".$row['food_img']."' class='small-slide-right'>
                    <div class='col-8'>
                        <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                        <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                        </h5></a>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

";

}elseif ($row['food_category'] == "PAPAS") {

    $papas .=	"   
    
    <a href='detail.php?fid=".$row['id']."'>
    <div class='swiper-slide'>
        <div class='card shadow-sm border-0'>
            <div class='card-body'>
                <div class='row no-gutters h-100'>
                    <img src='".$row['food_img']."' class='small-slide-right'>
                    <div class='col-8'>
                        <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                        <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                        </h5></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

";


}elseif ($row['food_category'] == "MICHELADAS") {

    $micheladas .=	"   
    
    <a href='detail.php?fid=".$row['id']."'>
    <div class='swiper-slide'>
        <div class='card shadow-sm border-0'>
            <div class='card-body'>
                <div class='row no-gutters h-100'>
                    <img src='".$row['food_img']."' class='small-slide-right'>
                    <div class='col-8'>
                        <a href='detail.php?fid=".$row['id']."' class='text-dark mb-1 mt-2 h6 d-block'>".$row['food_name']."</a>
                        <a href='detail.php?fid=".$row['id']."'><h5 class='text-success font-weight-normal mb-0'>$ ".$row['food_price']."
                        </h5></a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

";

                
            }

		}

	}else{



	}

?>

<div class="subtitle h6">
    <div class="d-inline-block">
        <i class="material-icons">home</i>
    </div>
</div>


<h6 class="subtitle text-center">BURRITOS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($burritos) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">ESPECIALIDADES</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($especialidades) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">QUESADILLAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($quesadillas) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">CHIMICHANGAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($chimichangas) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">NACHOS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($nachos) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">EXTRAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($extras) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">BANDEJAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($bandejas) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">PAPAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($papas) ?>
        </div>
    </div>
</div>

<h6 class="subtitle text-center">MICHELADAS</h6>
<div class="row">
    <!-- Swiper -->
    <div class='swiper-container small-slide'>
        <div class='swiper-wrapper'>
            <?php echo ($micheladas) ?>
        </div>
    </div>
</div>

