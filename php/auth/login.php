<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

// Include config file
require_once __DIR__ . "/../config/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$input_username = $input_password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] = "POST") {
    // if (empty(trim($_POST["username"]))) {
    //     $username_err = "Please enter username.";
    // } else {
    //     $username = trim($_POST["username"]);
    // }
    $input_username = $_POST['username']; // you should really do some more logic to see if it's set first
    echo "Username from POST : $input_username";
    // Check if username is empty
    if (empty(trim($input_username))) {
        $username_err = "Please enter username.";
    } else {
        $input_username = trim($input_username);
    }

    // Check if password is empty
    // if (empty(trim($_POST["password"]))) {
    //     $password_err = "Please enter your password.";
    // } else {
    //     $password = trim($_POST["password"]);
    // }
    $input_password = $_POST['password']; // you should really do some more logic to see if it's set first
    echo "password from POST : $password";
    if (empty(trim($input_password))) {
        $password_err = "Please enter your password.";
    } else {
        $input_password = trim($input_password);
    }

    echo "<div>username : " . $input_username . " password: " . $input_password . "</div>";

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        echo "<div>Validate user</div>";

        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $input_username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                echo "<div>After query</div>";

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $password);
                    echo "<div>db result : id: " . $id . " username : " . $username . " password : " . $password . "</div>";
                    echo "<div>Compare input password : " . $input_password . " db password : " . $password . "</div>";

                    if (mysqli_stmt_fetch($stmt)) {
                        $password_verify_status = password_verify($input_password, $password);
                        echo "<div>Compare passwords : " . $password_verify_status ? 'true' : 'false' . "</div>";

                        if ($password_verify_status) {
                            // Password is correct, so start a new session
                            echo "<div>Login successfully, start session</div>";

                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            echo "<div>Login successfully, redirect to welome.php</div>";

                            // Redirect user to welcome page
                            //$welcome_url = "http://10.0.0.36:8680/welcome.php";
                            //header("location: $welcome_url");
                            header("location: welcome.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>