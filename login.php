<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Include config file
require_once "connectionBD.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: home.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
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
    <title>Admin laboratorio clinico</title>
    <link href="" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style type="text/css">
        body {
            font: 14px sans-serif;
            background: url("./img/undraw_medicine_b1ol (1).png") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }

        .wrapper {
            width: 350px;
            padding: 20px;
            margin: auto;
        }

        .card {
            position: absolute;
            left: 35%;
            top: 20%;
            border: 2px solid rgba(0, 0, 0, .125);
            height: 65%;
            background-color: #f5f5f5;

        }

        .card-header {
            margin-bottom: 100%;
        }

        h2 {
            font-size: 26px;
        }

        h3 {
            font-size: 14px;
            font-weight: bold
        }

        .paragraph {
            position: absolute;
            bottom: 65%;
        }

        .user {
            position: absolute;
            bottom: 50%;
            width: 88%;
        }

        .user-error {
            position: absolute;
            top: 105%;
        }

        .password {
            position: absolute;
            bottom: 25%;
            width: 88%;
        }

        .paragraph1 {
            position: absolute;
            top: 90%;
        }

        .buttonlogin {
            position: absolute;
            top: 78%;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card border-primary mb-3">
            <div class="wrapper">
                <div class="card-header  bg-transparent border-primary">
                    <h2>Iniciar sesión</h2>
                </div>
                <p class="paragraph">Por favor, complete sus credenciales para iniciar sesión.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group user <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>
                            <h3>Usuario:</h3>
                        </label>
                        <input type="text" name="username" class="form-control bg-transparent border-primary" value="<?php echo $username; ?>">
                        <span class="help-block user-error  "><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group password <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>
                            <h3>Contraseña:</h3>
                        </label>
                        <input type="password" name="password" class="form-control bg-transparent border-primary">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group buttonlogin">
                        <input type="submit" class="btn btn-primary" value="Ingresar">
                    </div>
                    <p class="paragraph1">¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>