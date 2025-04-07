 <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $captcha_input = $_POST['captcha'];

    // Verificar el captcha
    if ($captcha_input === $_SESSION["captcha"]) {
        // Validar usuario y contraseña aquí
        echo "Captcha correcto. Procesando inicio de sesión...";
        // Aquí puedes agregar tu lógica de autenticación
    } else {
        echo "Captcha incorrecto. Inténtalo de nuevo.";
    }
}
?>