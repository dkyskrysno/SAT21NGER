<?php

    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: dashboard.php");
        exit;
    }

require_once "conexion.php";

$email = $password ="";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    if(empty(trim($_POST["email"]))){
        $email_err = "Silakan masukkan email";
    }else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Silakan masukkan kata sandi";
    }else{
        $password = trim($_POST["password"]);
    }
    
    
    

    //VALIDAR CREDENCIALES
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT id, usuario, email, clave FROM usuarios WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $usuario, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        // ALMACENAR DATOS EN VARABLES DE SESION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;
                        
                        header("location: dashboard.php");
                    }else{
                        $password_err = "Kata sandi yang Anda masukkan tidak valid";
                    }
                    
                } 
            }else{
                    $email_err = "Tidak ada akun yang ditemukan dengan email itu.";
                }
            
        }else{
                    echo "UPS! ada yang salah, saya akan mencobanya nanti";
                }
    }
    
    mysqli_close($link);
    
}

?>
























