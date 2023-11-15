<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<head>
    <title>Editar ficha</title>
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
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 30px;
}

h2 {
    color: black;
    text-align: left;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 20px;
}

h3 {
    color: white;
    text-align: left;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 21px;
}

h4 {
    color: white;
    text-align: left;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 15px;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

h5 {
    color: red;
    text-align: center;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 30px;

}

.buttons {
    justify-content: space-between;
}

p {
    font-family: Arial Rounded MT;
    font-size: 15px;
}

.btn-success {
    background-color: #2FD62D;
    color: black;
}

.btn-secondary {
    background-color: #4CB3FF;
    color: black;
}
</style>
<br>
<?php
include_once '../databases/BD.php';
$conexionBD=BD::crearInstancia();

$ID = $_GET['ID'];
//$sql = "SELECT * FROM datos WHERE ID = :ID";
$sql = "SELECT * FROM informacion WHERE ID = :ID";
$consulta = $conexionBD->prepare($sql);
$consulta->bindParam(':ID', $ID);
$consulta->execute();
$ficha = $consulta->fetch(PDO::FETCH_ASSOC);

$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch ($accion) {
        case 'Volver':
            header('Location: lista.php');
            break;
        case 'Guardar':
            //UPDATE `informacion` SET `ID`='[value-1]',`Identificación`='[value-2]',`Celular`='[value-3]',`Fecha`='[value-4]',`Profesión`='[value-5]',`Nombre`='[value-6]' WHERE 1
            $ID=$_POST['ID'];
            $Nombre= $_POST['Nombre'];
            $Identificación=$_POST['Identificación'];
            $Celular=$_POST['Celular'];
            $Profesión=$_POST['Profesión'];	
            $sql= "UPDATE informacion SET Identificación='$Identificación',Celular='$Celular',Profesión='$Profesión',Nombre='$Nombre' WHERE ID=$ID";
            $consulta = $conexionBD->prepare($sql);
            $consulta->execute();
            // Recargar los datos actualizados desde la base de datos
            $sql = "SELECT * FROM informacion WHERE ID = :ID";
            $consulta = $conexionBD->prepare($sql);
            $consulta->bindParam(':ID', $ID);
            $consulta->execute();
            $ficha = $consulta->fetch(PDO::FETCH_ASSOC);
            break;
        default:
            break;
    }
}
?>
<h1></h1>

<div>
    <form action="" method="post">
        <table width='60%' height='300px' bgcolor='#F2E6FE' border='3' align='center' style='margin: auto'><br>
            <h1>Información persona</h1>
            <tr>
                <th>ID:</th>
                <td><?php echo $ficha['ID']?></td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="Nombre" value="<?php echo $ficha['Nombre']?>"></td>
            </tr>
            <tr>
                <th>Identificación</th>
                <td><input type="number" name="Identificación" value="<?php echo $ficha['Identificación']?>"></td>
            </tr>
            <tr>
                <th>Celular:</th>
                <td><input type="number" name="Celular" value="<?php echo $ficha['Celular']?>"></td>
            </tr>
            <tr>
                <th>Profesión:</th>
                <td><input type="text" name="Profesión" value="<?php echo $ficha['Profesión']?>"></td>
            </tr>
        </table>
        <br>
        <div class='buttons'>
            <input type="hidden" name="ID" value="<?php echo $ficha['ID'];?>">
            <div class="btn-group" role="group" aria-label="" style="float: right">
                <button type="submit" name="accion" value="Guardar" class="btn btn-success"
                    onclick="alert('Cambios guardados correctamente');">Guardar</button>
                <button type="submit" name="accion" value="Volver" class="btn btn-secondary">Volver</button>
            </div>
        </div>
    </form>
</div>
<?php include("../templates/pie.php"); ?>
<br>