<?php 
    include_once __DIR__ . "/../config/koneksi.php";
    session_start();

    date_default_timezone_set('Asia/Jakarta');

    if(isset($_SESSION["is_login"])) {
        header("location: /home/services/services.php");
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);
    
        $sql = "SELECT * FROM user WHERE email='$email' AND 
        password='$hash_password'";
    
        $result = $konek->query($sql);
    
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["email"] = $data["email"];
            $_SESSION["is_login"] = true;

            $log_sql = "INSERT INTO session_logs (email, login_time) VALUES (?, ?)";
            $login_time = date('Y-m-d H:i:s');
            $log_stmt = $konek->prepare($log_sql);
            $log_stmt->bind_param("ss", $data["email"], $login_time);
            $log_stmt->execute();
            header("location: /home/services/services.php");

        } else {
            echo "<script>alert('PASSWORD ATAU EMAIL SALAH')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../assets/ic-dial-logo.png" sizes="32x64">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once __DIR__ . "/../config/bootstrap.php"?>
    <style>
        <?php include_once __DIR__ . "/../styles/style.css" ?>
    </style>
</head>
<body style="background: #000; height: 100vh; margin: 0; position: relative;">
    <!-- Background Image -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url(../assets/dial.jpeg); background-size: cover; background-position: center; opacity: 0.4; z-index: -1;"></div>

    <!-- Overlay Layer -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.2); z-index: -1;"></div>

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="login.php" class="d-grid gap-3" id="registrationForm" method="POST">
                                <div class="form-group">
                                    <img src="../assets/ic-dial-logo.png" alt="dial.png" class="mx-auto d-block w-50 mb-3">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required />
                                </div>
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</body>


</html>