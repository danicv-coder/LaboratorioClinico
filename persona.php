<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "connectionBD.php";

// Define variables and initialize with empty values
$nombre = $apellido = $telefono = $email = $edad =  $sexo = $direccion = $ciudad = $estado = $cd_postal = $fecha = $examen = $name_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Validate name
       // Validate username
    if (empty(trim($_POST["nombre"]))) {
        $name_err = "Por favor ingrese un usuario.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE nombre = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nombre);

            // Set parameters
            $param_nombre = trim($_POST["nombre"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este usuario ya fue tomado.";
                } else {
                    $username = trim($_POST["nombre"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

        // Prepare an insert statement
        $sql = "INSERT INTO patient (nombre, apellido, telefono, email, edad, sexo, direccion, ciudad, estado, cd_postal, examen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_nombre, $param_apellido, $param_telefono, $param_email, $param_edad, $param_sexo,$param_direccion, $param_ciudad, $param_estado, $param_codigo, $param_examen);

            // Set parameters
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_edad = $edad;
            $param_sexo = $sexo;
            $param_direccion = $direccion;
            $param_ciudad = $ciudad;
            $param_estado = $estado;
            $param_codigo = $cd_postal;
            $param_examen = $examen;
          

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: solitude.php");
            } else {
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }

             // Close statement
        mysqli_stmt_close($stmt);
        }
    // Close connection
    mysqli_close($link);
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin laboratorio clinico</title>
    <link href="" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Nueva persona</title>

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        h1 {
            font-size: 20px;
        }

        .bg-primary {
            background-color: #6f97d2 !important;
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
                        <a class="nav-link active " aria-current="page" href="persona.php">Registrar</a>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="row g-3" method="POST">
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="" aria-label="First name" name="nombre" value="<?php echo $nombre;?>">
                <span class="help-block  user-error"><?php echo $name_err; ?></span>
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Apellido</label>
                <input type="text" class="form-control" placeholder="" aria-label="First name" name="apellido" value="<?php echo $apellido; ?>">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Telefono</label>
                <input type="text" class="form-control" placeholder="" aria-label="First name" name="telefono" value="<?php echo $telefono; ?>">
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Edad</label>
                <input type="number" class="form-control" placeholder="" aria-label="First name" name="edad" value="<?php echo $edad; ?>">
            </div>

            <div class="col-md-2">
                <label for="inputState" class="form-label">Sexo</label>
                <select id="inputState" class="form-select" name="sexo" value="<?php echo $sexo; ?>">
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="" name="direccion" value="<?php echo $direccion; ?>">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="inputCity" name="ciudad" value="<?php echo $ciudad; ?>">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Estado</label>
                <select id="inputState" class="form-select" name="estado" value="<?php echo $estado; ?>">
                    <option value="amazonas" selected>Amazonas</option>
                    <option value="anzoátegui">Anzoátegui</option>
                    <option value="apure">Apure</option>
                    <option value="aragua">Aragua</option>
                    <option value="barinas">Barinas</option>
                    <option value="bolivar">Bolivar</option>
                    <option value="carabobo">Carabobo</option>
                    <option value="cojedes">Cojedes</option>
                    <option value="delta amacuro">Delta Amacuro</option>
                    <option value="distrito capital">Distrito Capital/option>
                    <option value="falcón">Falcón</option>
                    <option value="Guarico">Guarico</option>
                    <option value="Lara">Lara</option>
                    <option value="merida">Merida</option>
                    <option value="miranda">Miranda</option>
                    <option value="monagas">Monagas</option>
                    <option value="nueva esparta">Nueva Esparta</option>
                    <option value="portuguesa">Portuguesa</option>
                    <option value="sucre">Sucre</option>
                    <option value="tachira">Tachira</option>
                    <option value="trujillo">Trujillo</option>
                    <option value="vargas">Vargas</option>
                    <option value="yaracuy">Yaracuy</option>
                    <option value="zulia">Zulia</option>

                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Codigo postal</label>
                <input type="text" class="form-control" id="inputZip" name="cd_postal" value="<?php echo $cd_postal; ?>">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Tipo de examen</label>
                <select id="inputState" class="form-select" name="examen" value="<?php echo $examen; ?>">
                    <option selected value="hematologia">Hematologia</option>
                    <option value="liquidos organicos">Líquidos orgánicos</option>
                    <option value="urianalisis">Urianálisis</option>
                    <option value="parasitología">Parasitología</option>
                    <option value="inmunología">Inmunología</option>
                    <option value="bioquimica">Bioquímica</option>
                    <option value="coagulación">Coagulación</option>
                    <option value="endocrinologia">Endocrinología</option>
                    <option value="distrito">Distrito Capital</option>
                    <option value="toxicología">Toxicología</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" value="registrar">Registrar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>