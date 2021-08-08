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
$nombre = $apellido = $telefono = $email = $dni  = $edad =  $sexo = $direccion = $ciudad = $estado = $cd_postal = $fecha = $examen = $name_err = $lastName_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
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

                if (mysqli_stmt_num_rows($stmt)) {
                    $nombre = trim($_POST["nombre"]);
                } else {
                    $nombre = trim($_POST["nombre"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate last name
    if (empty(trim($_POST["apellido"]))) {
        $lastName_err = "Por favor ingrese un apellido";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE apellido = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_apellido);

            // Set parameters
            $param_apellido = trim($_POST["apellido"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $apellido = trim($_POST["apellido"]);
                } else {
                    $apellido = trim($_POST["apellido"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate phone
    if (empty(trim($_POST["telefono"]))) {
        $lastName_err = "Por favor ingrese un apellido";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE telefono = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_telefono);

            // Set parameters
            $param_telefono = trim($_POST["telefono"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $telefono = trim($_POST["telefono"]);
                } else {
                    $telefono = trim($_POST["telefono"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $lastName_err = "Por favor ingrese un email";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $email = trim($_POST["email"]);
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // validate DNI
    if (empty(trim($_POST["dni"]))) {
        $lastName_err = "Por favor ingrese su DNI";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE dni = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_dni);

            // Set parameters
            $param_dni = trim($_POST["dni"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $dni = trim($_POST["dni"]);
                } else {
                    $dni = trim($_POST["dni"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate age
    if (empty(trim($_POST["edad"]))) {
        $lastName_err = "Por favor ingrese una edad";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE edad = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_edad);

            // Set parameters
            $param_edad = trim($_POST["edad"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $edad = trim($_POST["edad"]);
                } else {
                    $edad = trim($_POST["edad"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate last name
    if (empty(trim($_POST["sexo"]))) {
        $lastName_err = "Por favor ingrese un apellido";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE sexo = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_sexo);

            // Set parameters
            $param_sexo = trim($_POST["sexo"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $sexo = trim($_POST["sexo"]);
                } else {
                    $sexo = trim($_POST["sexo"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate last name
    if (empty(trim($_POST["direccion"]))) {
        $lastName_err = "Por favor ingrese una dirección";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE direccion = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_direccion);

            // Set parameters
            $param_direccion = trim($_POST["direccion"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $direccion = trim($_POST["direccion"]);
                } else {
                    $direccion = trim($_POST["direccion"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate city
    if (empty(trim($_POST["ciudad"]))) {
        $lastName_err = "Por favor ingrese una ciudad";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE ciudad = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_ciudad);

            // Set parameters
            $param_ciudad = trim($_POST["ciudad"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $ciudad = trim($_POST["ciudad"]);
                } else {
                    $ciudad = trim($_POST["ciudad"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate states
    if (empty(trim($_POST["estados"]))) {
        $lastName_err = "Por favor eligir un estado";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE estado = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_estado);

            // Set parameters
            $param_estado = trim($_POST["estado"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $estado = trim($_POST["estado"]);
                } else {
                    $estado = trim($_POST["estado"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate code
    if (empty(trim($_POST["cd_postal"]))) {
        $lastName_err = "Por favor ingrese un codigo postal";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE cd_postal = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_codigo);

            // Set parameters
            $param_codigo = trim($_POST["cd_postal"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $cd_postal = trim($_POST["cd_postal"]);
                } else {
                    $cd_postal = trim($_POST["cd_postal"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate exam
    if (empty(trim($_POST["examen"]))) {
        $lastName_err = "Por favor seleccione un tipo de examen";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE examen = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_examen);

            // Set parameters
            $param_examen = trim($_POST["examen"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt)) {
                    $examen = trim($_POST["examen"]);
                } else {
                    $examen = trim($_POST["examen"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Prepare an insert statement
    $sql = "INSERT INTO patient (nombre, apellido, telefono, email, dni, edad, sexo, direccion, ciudad, estado, cd_postal, examen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_nombre, $param_apellido, $param_telefono, $param_email, $param_dni, $param_edad, $param_sexo, $param_direccion, $param_ciudad, $param_estado, $param_codigo, $param_examen);

        // Set parameters
        $param_nombre = $nombre;
        $param_apellido = $apellido;
        $param_telefono = $telefono;
        $param_email = $email;
        $param_dni = $dni;
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
            font-weight: bold;
        }

        .container h1 {
            margin-top: 20px;
            margin-left: 10px;
        }

        .bg-primary {
            background-color: #1F3A68 !important;

        }

        .bg-secundary {
            color: #8198C9;
        }

        .form {
            margin-top: 30px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            border: 3px solid #1F3A68;
            padding: 10px;
            height: 480px;
        }

        .formInput {
            padding: 10px;
            height: 460px;
        }
        .input{
            position: relative;
            top: 18px;
        }
        .inputStyle {
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            border: 1px solid #8198C9;
            color: #1F877A;
            font-weight: bold;
        }
        
        .buttonSubmit{
            margin-top: 30px;
        }
        .button-primary{
            background-color: #1F3A68;
            color: white;
        }
        .button-primary:hover{
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
                        <a class="nav-link " aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="persona.php">Registrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="results.php">Enviar resultados</a>
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
        <h1>Datos del paciente</h1>
        <div class="form">
            <div class="formInput">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-6" method="post">
                    <div class="col-md-6  <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label for="inputPassword4" class="form-label">Nombre</label>
                        <input type="text" class="form-control inputStyle" placeholder="" aria-label="First name" name="nombre" value="<?php echo $nombre; ?>">
                        <span class="help-block  user-error"><?php echo $name_err; ?></span>
                    </div>

                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Apellido</label>
                        <input type="text" class="form-control inputStyle" placeholder="" aria-label="First name" name="apellido" value="<?php echo $apellido; ?>">
                    </div>

                    <div class="col-md-6 input">
                        <label for="inputPassword4" class="form-label">Telefono</label>
                        <input type="text" class="form-control inputStyle" placeholder="" aria-label="First name" name="telefono" value="<?php echo $telefono; ?>">
                    </div>

                    <div class="col-md-6 input">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control inputStyle" id="inputEmail4" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="col-md-6 input">
                        <label for="inputPassword4" class="form-label">DNI</label>
                        <input type="text" class="form-control inputStyle" placeholder="" aria-label="First name" name="dni" value="<?php echo $dni; ?>">
                    </div>


                    <div class="col-md-2 input">
                        <label for="inputPassword4" class="form-label">Edad</label>
                        <input type="number" class="form-control inputStyle" placeholder="" aria-label="First name" name="edad" value="<?php echo $edad; ?>">
                    </div>

                    <div class="col-md-2 input">
                        <label for="inputState" class="form-label">Sexo</label>
                        <select id="inputState" class="form-select inputStyle" name="sexo" value="<?php echo $sexo; ?>">
                            <option class="inputStyle" value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                        </select>
                    </div>

                    <div class="col-12 input">
                        <label for="inputAddress" class="form-label">Dirección</label>
                        <input type="text" class="form-control inputStyle" id="inputAddress" placeholder="" name="direccion" value="<?php echo $direccion; ?>">
                    </div>
                    <div class="col-md-6 input">
                        <label for="inputCity" class="form-label">Ciudad</label>
                        <input type="text" class="form-control inputStyle" id="inputCity" name="ciudad" value="<?php echo $ciudad; ?>">
                    </div>
                    <div class="col-md-4 input">
                        <label for="inputState" class="form-label">Estado</label>
                        <select id="inputState" class="form-select inputStyle" name="estado" value="<?php echo $estado; ?>">
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
                    <div class="col-md-2 input">
                        <label for="inputZip" class="form-label">Codigo postal</label>
                        <input type="text" class="form-control inputStyle" id="inputZip" name="cd_postal" value="<?php echo $cd_postal; ?>">
                    </div>
                    <div class="col-md-4 input ">
                        <label for="inputState" class="form-label">Tipo de examen</label>
                        <select id="inputState" class="form-select inputStyle" name="examen" value="<?php echo $examen; ?>">
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
                    <div class="col-12 buttonSubmit">
                        <button type="submit" class="btn button-primary" name="submit" value="registrar">Registrar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>