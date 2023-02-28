<?php
session_start();
ob_start();
//    var_dump($_SESSION);

if (!isset($_SESSION['carrito'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>Sin productos en el carrito</h1>
    </body>

    </html>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>Productos</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Catidad</th>
                <th>Precio</th>
            </tr>

            <?php
            foreach ($_SESSION['carrito'] as $key => $producto) {
                // var_dump($producto,$key);
                echo '<tr>';
                echo '<td>' . $producto['titulo'] . '</td>';
                echo '<td>' . $producto['cantidad'] . '</td>';
                echo '<td>' . $producto['precio'] . '</td>';
                echo '</tr>';
            }

            ?>

            <tr>
                <td>Total</td>
                <td></td>
                <td>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $key => $producto) {
                        $total += $producto['precio'];
                    }
                    echo $total;
                    ?>
                </td>
            </tr>
        </table>
    </body>

    </html>
<?php
}



// die();
?>



<?php
$html = ob_get_clean();
// echo $html;
// die();
// require_once ('dompdf/dompdf_config.inc.php');
// use Dompdf\Dompdf;
// require 'vendor/autoload.php';
// require_once 'vendor\dompdf\dompdf\src\Dompdf.php';
// use Dompdf\Dompdf;
require_once('Package/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
// Introducimos HTML de prueba
// $html = '<h1>Hola mundo!</h1>';

// Instanciamos un objeto de la clase DOMPDF.
$pdf = new Dompdf();

// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");

// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));

// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.

// $pdf->stream('ticket.pdf');

//envio por correo
file_put_contents('tempfiles/ticket.pdf', $pdf->output());


// echo base64_encode($pdf->output());
// die();      