<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<head>
    <title>Fichas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    </link>
</head>

</html>
<?php include("../templates/cabecera.php"); ?>
<br>
<style>
body {
    background-color: #6724AD;
}

h1 {
    color: white;
    text-align: center;
}

h2 {
    color: black;
    text-align: center;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 50px;
}

p {
    font-family: Arial Rounded MT;
    font-size: 15px;
}

.button {
    margin-left: 90%;
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin: 4px 2px;
}

.btn-secondary {
    background-color: #2FD62D;
    color: black;
}

.btn-BLUE {
    background-color: #4CB3FF;
    color: black;
}
</style>
<br>
<?php
//INSERT INTO `datos` (`id`, `placa`, `fecha`) VALUES ('', NULL, current_timestamp())
include_once '../databases/BD.php';
$conexionBD=BD::crearInstancia();
$consulta=$conexionBD->prepare("SELECT * FROM informacion");
$consulta->execute();
$result= $consulta->fetchALL();

$ID=isset($_POST['ID'])?$_POST['ID']:'';

$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch ($accion) {
        case 'Editar':
            header('Location: editar.php?ID=' . $ID);
            break;
        case 'Borrar':
            try {
                // Comienza la transacción
                $conexionBD->beginTransaction();

                $sql = "DELETE FROM informacion WHERE ID=:ID";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':ID',$ID);
                $consulta->execute();
                $conexionBD->commit();
            } catch (Exception $e) {

                $conexionBD->rollback();
                echo "Error: " . $e->getMessage();
            }
            header ('Location: lista.php');
            break;
        default:
            break;
    }
}
?>
<div class="col-md-12 d-flex" style="margin-top:50px;">

    <div class=" mb-3">
        <form method="post" action="buscar.php">


            <div class="btn-group" aria-label="">
                <input type="text" class="form-control" name="buscar_valor" placeholder="Buscar"
                    style="width: 500px; border-radius: 50px;">
                <input type="submit" class="btn btn-BLUE" name="b1" value="Buscar" style="border-radius: 10px;" />
            </div>

    </div>

</div>
<br>
<div class='table'>
    <table class='table' width='100' bgcolor='#F2E6FE'><br>
        <tr>
            <th scope='col'>ID</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Identificación</th>
            <th scope='col'>Celular</th>
            <th scope='col'>Profesión</th>
            <th scope='col'>Ultima actualización</th>
            <th scope='col' style="text-align: center;">Acción</th>
        </tr>
        <?php foreach($result as $ficha){?>
        <tr>
            <td> <?php echo $ficha['ID']?> </td>
            <td> <?php echo $ficha["Nombre"]?> </td>
            <td> <?php echo $ficha["Identificación"]?> </td>
            <td> <?php echo $ficha["Celular"]?> </td>
            <td> <?php echo $ficha["Profesión"]?> </td>
            <td> <?php echo $ficha["Fecha"]?> </td>
            <td style="text-align: center;">
                <form action="" method="post">
                    <input type="hidden" name="ID" value="<?php echo $ficha['ID'];?>">
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="Editar" class="btn btn-success">Editar</button>
                        <button type="submit" name="accion" value="Borrar" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de que quieres borrar este registro?');">Borrar</button>
                    </div>
                </form>
            </td>
        </tr>
        <?php }?>

    </table>
</div>
<div class='button'>
    <form action='agregar.php' method='post'>
        <input type='submit' value='Agregar' name='agregarficha' class='btn btn-secondary'>
    </form>
</div>
<br>

<?php include("../templates/pie.php"); ?>