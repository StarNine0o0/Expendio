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
            <h2>Bienvenido a Expendio</h2>
            <p class="login-subtitle">Ingresa tu correo y contraseña para poder continuar</p>

            <form id="loginForm">
                <div class="login-input">
                    <span class="login-icon">📧</span>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="login-input">
                    <span class="login-icon">🔒</span>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <button type="submit" class="login-btn" id="continuar-btn">
                    Continuar
                    <span class="spinner" id="spinner" style="display:none;"></span>
                </button>
            </form>

            <div class="login-divider">o ingresa con</div>
            <div class="login-social">
                <button class="social-btn facebook">f</button>
                <button class="social-btn google">G</button>
                <button class="social-btn apple"></button>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const spinner = document.getElementById('spinner');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            spinner.style.display = "inline-block";

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch("http://localhost:8000/api/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();
                spinner.style.display = "none";

                if (response.ok) {
                    // Guardar token o datos
                    localStorage.setItem("token", data.token);
                    localStorage.setItem("user", JSON.stringify(data.user));

                    // Redirigir a menú
                    window.location.href = "menu.html";
                } else {
                    alert(data.message || "Credenciales incorrectas");
                }
            } catch (error) {
                spinner.style.display = "none";
                alert("Error de conexión con el servidor");
                console.log(error);
            }
        });
    </script>

</body>
</html>
