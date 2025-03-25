<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="./recursos/sweetalert2.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="../img/logo.png" alt="Logo Clínica" class="logo">
                <h1>Clínica Dental</h1>
            </div>
            
            <form action="./php/loginAdmin.php" id="loginForm" class="login-form" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                </div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>
                
                
                
                <button type="submit" class="btn btn-primary w-100">
                    Iniciar Sesión
                </button>
                
                <div class="text-center mt-3">
                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./recursos/sweetalert2.all.min.js"></script>
    
</body>
</html>