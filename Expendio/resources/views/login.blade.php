<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Expendio</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
     <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="login-bg">
    <div class="login-flex-container">
        <div class="login-logo">
            <img src="img/logo.png" alt="Logo Expendio" />
        </div>
        <div class="login-container">
            <div class="login-avatar">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Avatar" />
            </div>
            <h2>Bienvenido a Expendio</h2>
            <p class="login-subtitle">Ingresa tu correo y contraseña para poder continuar</p>
            <form>
                <div class="login-input">
                    <span class="login-icon">📧</span>
                    <input type="email" placeholder="Email" required><!-- Requerido para continuar  -->
                </div>
                <div class="login-input">
                    <span class="login-icon">🔒</span>
                    <input type="password" placeholder="Contraseña" required>  <!-- Requerido para continuar  -->
                </div>
                <button type="submit" class="login-btn" id="continuar-btn">
                    Continuar
                    <span class="spinner" id="spinner" style="display:none;"></span>
                </button>
            </form>
            <div class="login-divider">o regístrate con</div>
            <div class="login-social">
                <button class="social-btn facebook">f</button>
                <button class="social-btn google">G</button>
                <button class="social-btn apple"></button>
            </div>
        </div>
    </div>

    <script>
        function handleLogin(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Credenciales de prueba (en producción deberías validar con backend)
            if (username === 'admin' && password === 'admin123') {
                // Guardar sesión
                localStorage.setItem('userLoggedIn', 'true');
                localStorage.setItem('username', username);
                
                // Redirigir al menú principal
                window.location.href = 'menu.html';
            } else {
                alert('Usuario o contraseña incorrectos');
            }
        }

        // Verificar si ya está logueado
        window.onload = function() {
            if (localStorage.getItem('userLoggedIn') === 'true') {
                window.location.href = 'menu.html';
            }
        };
    </script>
</body>
</html>
