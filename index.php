<?php
include('apigoogle.php');

$login_button = '';


if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);


        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);


        $data = $google_service->userinfo->get();


        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}


if (!isset($_SESSION['access_token'])) {

    $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/EstilosComunes.css">
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>
    <div class="contenedor">
        <form action="./config/login.php" method="post">
            <h1>Iniciar Sesión</h1>
            <label for="CorreoElectronico">CorreoElectronico<input type="email" name="CorreoElectronico"
                    id="CorreoElectronico"></label>
            <label for="Contraseña">Contraseña<input type="password" name="Contraseña" id="Contraseña"></label>
            <a href="recuperacion.html">¿Olvidaste tu Contraseña?</a>

            <button type="submit">Iniciar sesión</button>
            <button type="reset">Cancelar</button>

            <?php
            if ($login_button == '') {
                echo "<script>location.href='inicio.html'</script>";
            } else {
                echo '<div>' . $login_button . '</div>';
            }
            ?>
        </form>
    </div>
    <footer class="footer">
        Copyright © 2020 SERVICIO AUTOMOTRIZ AUTOMASTER - Todos los derechos reservados.
        <br>
        <a style="color: white; font-size: large;" href="aviso.html">AVISO DE PRIVACIDAD</a>
    </footer>
</body>

</html>