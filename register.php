<?php
// Include config file
require_once "connectionBD.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese un usuario.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

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

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingresa una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confirma tu contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "No coincide la contraseña.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Algo salió mal, por favor inténtalo de nuevo.";
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

        .card{
            position: absolute;
            left: 35%;
            top: 10%;
            border: 2px solid rgba(0,0,0,.125);
            height: 75%;
            background-color: #f5f5f5;
            
        }

        .card-header{
            margin-bottom: 120%;
        }

        h2{
            font-size: 26px;
        }

        h3{
            font-size: 14px;
            font-weight: bold
        }
        .paragraph{
            position: absolute;
            bottom: 70%;
        }

        .user{
            position: absolute;
            bottom: 59%;
            width: 88%;
        }

        .user-error{
            position: absolute;
            top: 105%;
        }

        .password{
            position: absolute;
           bottom: 20%;
           width: 88%;
        }

        .password-confir{
            position: absolute;
           bottom: 40%;
           width: 88%;
        }

        .paragraph1{
            position: absolute;
            top: 93%;
        }

        .buttonlogin{
            position: absolute;
            top: 83%;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="card border-primary mb-3">
            <div class="wrapper">
            <div class="card-header  bg-transparent border-primary"><h2>Registro</h2></div> 
                <p class="paragraph">Por favor complete este formulario para crear una cuenta.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group  user <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label><h3>Nombre:</h3></label>
                        <input type="text" name="username" class="form-control  bg-transparent border-primary" value="<?php echo $username; ?>">
                        <span class="help-block  user-error"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group  password <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label><h3>Contraseña:</h3></label>
                        <input type="password" name="password" class="form-control form-control bg-transparent border-primary" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group password-confir <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label><h3>Confirmar Contraseña:</h3></label>
                        <input type="password" name="confirm_password" class="form-control bg-transparent border-primary" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group buttonlogin">
                        <input type="submit" class="btn btn-primary" value="Ingresar">
                        <input type="reset" class="btn btn-default" value="Borrar">
                    </div>
                    <p class="paragraph1">¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>