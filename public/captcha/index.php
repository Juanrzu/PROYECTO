<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('btn_recargar').addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelector('img').src = 'captcha.php?' + new Date().getTime();
            });
        });
    </script>
</head>
<body>
    <h2>Login</h2>
    <form id="frm" action="login.php" method="POST">
        <table>
            <tr>
                <td>Usuario</td><td><input type="text" name="user" required></td>
            </tr>
            <tr>
                <td>Password</td><td><input type="password" name="pass" required></td>
            </tr>
            <tr>
                <td><img src="captcha.php"></td>
                <td><input type="text" name="captcha" required></td>
                <td><button id="btn_recargar">Recargar</button></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" id="btn_iniciar" value="login"></td>
            </tr>
        </table>
    </form>
</body>
</html>
