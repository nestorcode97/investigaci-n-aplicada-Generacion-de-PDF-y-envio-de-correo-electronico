<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<title>Carrito de compras</title>
</head>
<body>


<?php 
// var_dump($_SESSION['carrito']);
// die();
error_reporting(0);
$carrito_mio = $_SESSION['carrito'];
$_SESSION['carrito']=$carrito_mio;

if(isset($_SESSION['carrito'])){
    for($i=0;$i<=count($carrito_mio)-1;$i ++){
    if($carrito_mio[$i]!=NULL){ 
    $total_cantidad = $carrito_mio['cantidad'];
    $total_cantidad ++ ;
    $totalcantidad += $total_cantidad;
    }}}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="#">DETECHNOLOGY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" 
          style="color: grey;"> <i class="fas fa-shopping-cart"></i> <?php echo $totalcantidad; ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<div class="modal fade" id="modal_cart" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   
   
     
			<div class="modal-body">
				<div>
					<div class="p-2">
						<ul class="list-group mb-3">
							<?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
							if($carrito_mio[$i]!=NULL){
						
            ?>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="row col-12" >
									<div class="col-6 p-0" style="text-align: left; color: #000000;"><h6 class="my-0">Cantidad: <?php echo $carrito_mio[$i]['cantidad'] ?> : <?php echo $carrito_mio[$i]['titulo']; // echo substr($carrito_mio[$i]['titulo'],0,10); echo utf8_decode($titulomostrado)."..."; ?></h6>
									</div>
									<div class="col-6 p-0"  style="text-align: right; color: #000000;" >
									<span   style="text-align: right; color: #000000;"><?php echo $carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad'];    ?> $</span>
									</div>
								</div>
							</li>
							<?php
							$total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
							}
							}
							}
							?>
							<li class="list-group-item d-flex justify-content-between">
							<span  style="text-align: left; color: #000000;">Total (USD)</span>
							<strong  style="text-align: left; color: #000000;"><?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
							if($carrito_mio[$i]!=NULL){ 
							$total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
							}}}
							echo $total; ?> $</strong>
							</li>
						</ul>
					</div>
				</div>
			</div>
			


      </div>
      <form class="modal-footer" method="post" action="enviar.php">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <?php 

         ?>
        <a type="button" class="btn btn-primary" href="borrarcarro.php">Vaciar carrito</a>
        <a type="button" class="btn btn-primary" href="imprimir.php">Imprimir ticket</a>
        <input type="submit" class="btn btn-primary">enviar correo</input>
        <input type="email" class="" name="email" ></input>

            </form>
    </div>
  </div>
</div>






<div class="container mt-5">
<div class="row" style="justify-content: center;">

<?php

// Cargar archivo xml
$xml_str = file_get_contents('./productos.xml');
// Convertir string xml en Objeto XML de PHP
$xml   = simplexml_load_string($xml_str);
// Convertir Objeto XML en String de JSON
$json_str = json_encode((array) $xml);
// Convertir String de JSON en Array de PHP
$array = json_decode($json_str,true);
// Lista de productos
$productos = $array["producto"];

foreach ($productos as $producto) {
    $titulo = $producto["titulo"];
    $desc = $producto["descripcion"];
    $precio = $producto["precio"];
    $img = "img/".$producto["img"];

    $precio_str = "&#36;".number_format($producto["precio"], 2, ".");
    $desc = trim($desc)." - ".$precio;

?>
<div class="card m-4" style="width: 18rem;">
        <form id="formulario" name="formulario" method="post" action="cart.php">
        <input name="precio" type="hidden" id="precio" value="<?php echo $precio; ?>" />
        <input name="titulo" type="hidden" id="titulo" value="<?php echo $titulo; ?>" />
        <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
        <img src="<?php echo $img; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title"><?php echo $titulo; ?></h5>
                        <p class="card-text"><?php echo $desc; ?></p>
                        <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                </div>
        </form>
</div>
<?php
}
?>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
</body>
</html>
