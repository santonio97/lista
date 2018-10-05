<?php
include 'funciones.php'; 
$productos = array();
$error = null;
if (isset($_POST['insertar'])) {
    if (isset($_POST['nombres'])) {
        for ($i=0; $i<count($_POST['nombres']); $i++) {
            $producto = array();
            $producto['nombre'] = $_POST['nombres'][$i];
            $producto['cantidad'] = $_POST['cantidades'][$i];
            $producto['precio'] = $_POST['precios'][$i];
            $producto['total'] = $_POST['totales'][$i];
            $productos[] = $producto;
        }
        
    }
    if(empty($_POST['nombre'])){
        $error = "El nombre está vacío";
    }
    $producto = array();
        $producto['nombre']=$_POST['nombre'];
        $producto['cantidad']=$_POST['cantidad'];
        $producto['precio']=$_POST['precio'];
        Calcular_Precio_Total_Producto($producto);
        $productos[] = $producto;
    
}
if (isset($_POST['borrar'])) {
    if (isset($_POST['nombres'])) {
        for ($i=0; $i<count($_POST['nombres'].borrado); $i++) {
            $producto = array();
            $producto['nombre'] = $_POST['nombres'][$i];
            $producto['cantidad'] = $_POST['cantidades'][$i];
            $producto['precio'] = $_POST['precios'][$i];
            $producto['total'] = $_POST['totales'][$i];
            $productos[] = $producto;
        }
        $nombre = $_POST['borrado'];
        for ($i=0 ; $i < count($productos) ; $i++){
            if($productos[$i]['nombre'] == $nombre){
                unset($productos[$i]);
                $productos = array_values($productos);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de la compra</title>
</head>
<body>
    
    <h1>LISTA DE LA COMPRA DEL <?php echo date("j/m/Y"); ?></h1>
    
    <table border="1" bordercolor="0055ff">
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <?php
            foreach ($productos as $producto) {
                echo "<tr>
                <td>".$producto['nombre']."</td>
                <td>".$producto['cantidad']."</td>
                <td>".$producto['precio']."</td>
                <td>".$producto['total']."</td>
                </tr>";
            }
            print"<tr><td colspan=3> Total de compra</td>
            <td>".Calcular_Precio_Total_Compra($productos)."€</td>
            </tr>"
        ?>
    </table>

    <br/><hr/>
    
    <h4>Insertar producto</h4>
    <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        Nombre&nbsp;<input type="text" name="nombre" value="<?php if (isset ($_POST['nombre'])) echo 
        $_POST['nombre'];?>"/> 
        Cantidad&nbsp;<input type="text" name="cantidad" value="<?php if (isset ($_POST['cantidad'])) echo 
        $_POST['cantidad'];?>"/>
        Precio&nbsp;<input type="text" name="precio" value="<?php if (isset ($_POST['precio'])) echo 
        $_POST['precio'];?>"/><br><br>
        
        <input type="submit" value="Insertar" name="insertar"/>
        <?php
        foreach($productos as $producto) {
            echo '<input type="hidden" name="nombres[]" value="' . $producto['nombre'] . '" />';
            echo '<input type="hidden" name="cantidades[]" value="' . $producto['cantidad'] . '" />';
            echo '<input type="hidden" name="precios[]" value="' . $producto['precio'] . '" />';
            echo '<input type="hidden" name="totales[]" value="' . $producto['total'] . '" />';
        }
        ?>
    </form>

    <h4>Borrar producto</h4>
    <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <select name="borrado">
        <?php
            foreach($productos as $producto ){
                    print"
                    <option>".$producto['nombre']."</option>";
            }
        ?>
        <input type="submit" value="Borrar" name="borrar"/>
        </select>

        <?php foreach($productos as $producto) {
            echo '<input type="hidden" name="nombres[]" value="' . $producto['nombre'] . '" />';
            echo '<input type="hidden" name="cantidades[]" value="' . $producto['cantidad'] . '" />';
            echo '<input type="hidden" name="precios[]" value="' . $producto['precio'] . '" />';
            echo '<input type="hidden" name="totales[]" value="' . $producto['total'] . '" />';
        }
        ?>
    </form>
</body>
</html>
