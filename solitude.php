<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$inc = require_once "connectionBD.php";

// Define variables and initialize with empty values
/* $nombre = $dni = $email = $fechaReg = ""; */
if ($inc) {
    $consulta = "SELECT * FROM patient";
    $resultado = mysqli_query($link, $consulta);
    if ($resultado) {
        while ($row = $resultado->fetch_array()) {
            $nombre = $row['nombre'];
            $dni = $row['Dni'];
            $email = $row['email'];
            $examen = $row['examen'];
            $fechaReg = $row['created_at'];
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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        h1 {
            font-size: 20px;
        }

        h2 {
            font-size: 30px;
        }

        .bg-primary {
            background-color: #6f97d2 !important;
        }

        .patient {
            margin-top: 50px;
            border: 1px solid #C00;
            height: 200px;
        }

        .header {
            border: 1px solid #C00;
            height: 90px;
            display: flex;
        }

        .header h3 {
            margin-top: 23px;
        }

        img {
            height: 85px;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
        }
        .date{
            margin-left: 10px;
        }
        .buttonResult{
            display: flex;
            justify-content: flex-end;
            position: relative;
            bottom: 50px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <h1><b>@<?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="persona.php">Registrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="solitude.php">Solitud examenes</a>
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>solitud de examenes:</h2>

        <div class="patient">
            <div class="header">
                <img src="img/logo-for-a-dental-clinic-vector-illustration.jpg"></img>
                <h3>Clinica San francisco DC</h3>
            </div>
            <div class="date">
                <p class="name"><?php echo $nombre ?></p>
                <p>
                    <b>DNI: <?php echo $dni ?> </b> <br>
                    <b> Email: <?php echo $email ?></b> <br>
                    <b> Tipo de examen: <?php echo $examen ?></b> <br>
                    <b>Fecha de la solitud: <?php $fechaReg ?></b> <br>
                    <span class="buttonResult"><input type="submit" class="btn btn-primary" value="Resultados"></span>
                </p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>