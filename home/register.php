<?php
include_once __DIR__ . "/../config/koneksi.php";
session_start();

if (isset($_SESSION["is_login"])) {
    header("location: /home/services/services.php");
}

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hash_password = hash('sha256', $password);


    $sql = "INSERT INTO user (email, username, name, password) VALUES 
        ('$email', '$username', '$name', '$hash_password')";

    try {
        if ($konek->query($sql)) {
            echo "<script>alert('DAFTAR AKUN BERHASIL, SILAHKAN LOGIN')</script>";
        } else {
            echo "<script>alert('DAFTAR AKUN GAGAL, COBA LAGI')</script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('SALAH SATU DATA SUDAH DIGUNAKAN')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/register.css">
    <?php include_once __DIR__ . "/../config/bootstrap.php"?>
</head>
<body style="background: #001F3F">
        <div class="wrapper">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <form class="d-grid gap-3" id="registrationForm" action="register.php" method="post">
                                    <div class="form-group">
                                        <h2 class="text-center">Register</h2>
                                        <label for="email">
                                            Email
                                        </label>
                                        <input type="email"  
                                            name="email"
                                            class="form-control" 
                                            id="email" 
                                            placeholder="Email" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">
                                        Create new Username
                                        </label>
                                        <input type="text" 
                                            name="username"
                                            class="form-control" 
                                            id="username" 
                                            placeholder="Username"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">
                                        Create new Name
                                        </label>
                                        <input type="text" 
                                            name="name"
                                            class="form-control" 
                                            id="name" 
                                            placeholder="Name"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                        Create new Password
                                        </label>
                                        <input type="password"  
                                            name="password"
                                            class="form-control" 
                                            id="password" 
                                            placeholder="Password"
                                            required />
                                    </div>
                                    <button type="submit" 
                                            name="register" 
                                            class="btn btn-primary">
                                        Register
                                    </button>
                                </form>
                                <p class="mt-3">
                                    Have an Account?
                                    <a href="login.php">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>