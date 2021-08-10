<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$inc = require_once "connectionBD.php";

if ($inc) {
    $consulta = "SELECT * FROM patient";
    $resultado = mysqli_query($link, $consulta);
    if ($resultado) {
        while ($row = $resultado->fetch_array()) {
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $telefono = $row['telefono'];
            $email = $row['email'];
            $dni = $row['Dni'];
            $edad = $row['edad'];
            $sexo = $row['sexo'];
            $direccion = $row['direccion'];
            $ciudad = $row['ciudad'];
            $estado = $row['estado'];
            $cd_postal = $row['cd_postal'];
            $examen = $row['examen'];
        }
    }
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin laboratorio clinico</title>
    <link href="" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        h1 {
            font-size: 20px;
        }

        .bg-primary {
            background-color: #1F3A68 !important;

        }

        .bg-secundary {
            color: #8198C9;
        }


        .title {
            display: flex;
        }

        .name {
            font-size: 30px;
            margin-top: 50px;
        }

        .logo {
            height: 250px;
        }

        .button-primary {
            background-color: #1F3A68;
            color: white;
        }

        .button-primary:hover {
            background-color: #204683;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <h1 class="bg-secundary"><b>@<?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="persona.php">Registrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="solitude.php">Solitud examenes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="results.php">Enviar resultados</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Configuración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="reset-password.php">Cambiar contraseña</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Cerrar sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div>
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Datos personales del paciente</li>
                <li class="list-group-item"><b>Nombre:</b> <?php echo $nombre ?></li>
                <li class="list-group-item"><b>Apellido:</b> <?php echo $apellido ?></li>
                <li class="list-group-item"><b>Telefono:</b> <?php echo $telefono?></li>
                <li class="list-group-item"><b>Email:</b> <?php echo $email ?></li>
                <li class="list-group-item"><b>DNI:</b> <?php echo $dni ?></li>
                <li class="list-group-item"><b>Edad:</b> <?php echo $edad?></li>
                <li class="list-group-item"><b>Sexo</b> <?php echo $sexo ?></li>
                <li class="list-group-item"><b>Dirección</b> <?php echo $direccion ?></li>
                <li class="list-group-item"><b>Ciudad:</b> <?php echo $ciudad?></li>
                <li class="list-group-item"><b>Estado:</b> <?php echo $estado ?></li>
                <li class="list-group-item"><b>Codigo postal:</b> <?php echo $cd_postal ?></li>
                <li class="list-group-item"><b>Tipo de examen:</b> <?php echo $examen ?></li>

            </ul>
        </div>
        <br>
        <div class="form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-6" method="post">
            <h1>Ingresar los resultados del examen:</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Estudio</th>
                            <th scope="col">Resultado</th>
                            <th scope="col">Unidades de referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>HEMOGRAMA</b></td>
                            <td></td>
                            <td></td>


                        </tr>
                        <tr>
                            <td>HEMOGLOBINA SANGRE TOTAL</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result1" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result2" value=""></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result3" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result4" value=""></td>
                        </tr>
                        <tr>
                            <td>HEMATIES RECUENTO</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result5" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result6" value=""></td>
                        </tr>
                        <tr>
                            <td>LEUCOCITOS RECUENTO</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result7" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result8" value=""></td>
                        </tr>
                        <tr>
                            <td>Neutrofilos mielocitos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result9" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result10" value=""></td>
                        </tr>
                        <tr>
                            <td>Neutrofilos metamielocitos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result11" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result12" value=""></td>
                        </tr>
                        <tr>
                            <td>Neutrofilos en cayado</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result13" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result14" value=""></td>
                        </tr>
                        <tr>
                            <td>Neutrofilos segmentados</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result15" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result16" value=""></td>
                        </tr>
                        <tr>
                            <td>Basófilos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result17" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result8" value=""></td>
                        </tr>
                        <tr>
                            <td>Eosinófilos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result19" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result20" value=""></td>
                        </tr>
                        <tr>
                            <td>Linfocitos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result21" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result22" value=""></td>
                        </tr>
                        <tr>
                            <td>Monocitos</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result23" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result24" value=""></td>
                        </tr>
                        <tr>
                            <td>Células de Downey</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result25" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result26" value=""></td>
                        </tr>
                        <tr>
                            <td>Observaciones</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result27" value=""></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Volumen corpuscular medio</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result28" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result29" value=""></td>
                        </tr>
                        <tr>
                            <td>Hemoglobina corpuscular media</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result30" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result31" value=""></td>
                        </tr>
                        <tr>
                            <td>Concentracion de hemoglobina corpuscular</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result32" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result33" value=""></td>
                        </tr>
                        <tr>
                            <td>Media</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result34" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result35" value=""></td>
                        </tr>
                        <tr>
                            <td>RDW</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result36" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result37" value=""></td>
                        </tr>
                        <tr>
                            <td><b>RETICULOCITOS RECUENTO</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Reticulocitos recuento valo relativo</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result38" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result39" value=""></td>
                        </tr>
                        <tr>
                            <td>Reticulocitos recuento valor absoluto</td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result40" value=""></td>
                            <td><input type="text" class="form-control" placeholder="" aria-label="First name" name="result41" value=""></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-12 buttonSubmit">
                    <button type="submit" class="btn button-primary" name="submit" value="registrar">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>