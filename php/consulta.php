<?php

session_start();

require "conexion.php";

$content = "";
$query = "SELECT * FROM food ORDER BY id";

if (isset($_POST['food'])) {
    $q = $db->real_escape_string($_POST['food']);
    $query = "SELECT * FROM food WHERE
                id LIKE '%".$q."%' OR 
                food_name LIKE '%".$q."%' OR
                food_category LIKE '%".$q."%' OR
                food_search LIKE '%".$q."%'
    ";
} 

$buscarSearch = $db->query($query);
if ($buscarSearch->num_rows > 0) {
    
    while ($row = $buscarSearch->fetch_assoc()) {
        $content.=
        '   
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-md-2 col-lg-2 align-self-center">
                        <figure class="product-image"><img src="'.$row['food_img'].'"></figure>
                    </div>
                    <div class="col">
                        <a href="detail.php?fid='.$row['id'].'" class="text-dark mb-1 h6 d-block">'.$row['food_name'].'</a>
                        <h5 class="text-success font-weight-normal mb-0">$ '.$row['food_price'].'
                        </h5>
                    </div>
                </div>
                <a href="detail.php?fid='.$row['id'].'"><button
                        class="btn btn-default button-rounded-36 shadow-sm float-bottom-right btnver"><i
                            class="material-icons md-18">input</i></button></a>
            </div>
        </div>
    </div>
</div>
        ';
    }
    
echo $content;

}