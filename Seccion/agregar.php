<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<head>
    <title>Agregar registro</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    </link>
</head>

</html>
<?php include("../templates/cabecera.php"); ?>
<style>
body {
    background-color: #6724AD;
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin: 4px 2px;
}

.btn-black {
    background-color: #4CB3FF;
    color: white;
    border-color: #4CB3FF;
    active-color: #4CB3FF;
    active-border-color: #4CB3FF;
    active-bg: #4CB3FF;
    hover-border-color: #4CB3FF;
    hover-color: #4CB3FF;
    hover-bg: #4CB3FF;
    margin-left: 80%;
}

.btn-outline-black {
    border-color: #4CB3FF;
    color: #4CB3FF;
    active-color: black;
    active-border-color: black;
    active-bg: black;
    hover-border-color: black;
    hover-color: black;
    hover-bg: black;
}

h4 {
    color: white;
    text-align: left;
    font-family: Arial Rounded MT;
    font-weight: bold;
    font-size: 15px;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

.card-header {
    background-color: #2FD62D;
    text-align: center;
}
</style>
<?php
include_once '../databases/BD.php';
$conexionBD=BD::crearInstancia();
$ID=isset($_POST['ID'])?$_POST['ID']:'';
$Nombre=isset($_POST['Nombre'])?$_POST['Nombre']:'';
$Identificación=isset($_POST['Identificación'])?$_POST['Identificación']:'';
$Celular=isset($_POST['Celular'])?$_POST['Celular']:'';
$Profesión=isset($_POST['Profesión'])?$_POST['Profesión']:'';	

$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch ($accion) {
        case 'Guardar':
            $sql="INSERT INTO informacion(ID,Nombre,Identificación,Celular,Profesión,Fecha) VALUES (NULL, '$Nombre','$Identificación', '$Celular', '$Profesión', current_timestamp())";
            $consulta=$conexionBD->prepare($sql);
            $consulta->execute(); 
            header('Location: lista.php');
            break;
        default:
            break;
    }
}
?>


<html>
<div class="container" style="margin-top: 50px; width: 1000px; ">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header">
                        Agregar registro
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" aria-describedby="helpId"
                                placeholder="Ej: Pepito Pablo Paz Lozano" required pattern=".{7,}"
                                title="Ingresa tu nombre completo">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Identificación</label>
                            <input type="number" class="form-control" name="Identificación" id="Identificación"
                                aria-describedby="helpId" placeholder="Ej: 0123456789" required pattern=".{8,}"
                                title="Ingresa una identificación válida">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Celular</label>
                            <input type="number" class="form-control" name="Celular" id="Celular"
                                aria-describedby="helpId" placeholder="Ej: 3001001010" required pattern=".{10,}"
                                title="Ingresa un numero de celular válido">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Profesión</label>
                            <input type="text" class="form-control" name="Profesión" id="Profesión"
                                aria-describedby="helpId" placeholder="Igeniero, abogado, profesor, etc." required
                                pattern=".{2,}" title="Ingresa tu una profesión válida">
                        </div>
                        <button type="submit" name="accion" value="Guardar" class="btn btn-black">Guardar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</html>

<?php include("../templates/pie.php"); ?>