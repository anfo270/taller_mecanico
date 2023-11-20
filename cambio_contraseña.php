<?php
require "./config/metodosusuario.php";
$id = $_GET['id'];
$resultado = Consulta_usuario_id($id);
$row = $resultado->fetch_assoc();
echo (is_string($row['Id']));
if ($row && isset($row['Id'])) {
    // Accede al valor de 'Id' aquí
    $id = $row['Id'];
} else {
    echo '<script>alert("No se encontró el usuario")</script>';
    echo "<script>location.href='./login.html'</script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="./css/EstilosComunes.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="contenedor">

        <form action="./config/cambioscontraseña.php" method="post">

            <h1>Cambiar Contraseña</h1>

            <input name="id" id="id" value="<?php echo $id; ?>" type="hidden">
            <label for="Contraseña">Ingresa Tu nueva contraseña
                <input type="password" name="Contraseña" id="Contraseña" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$"
                    title="La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número"
                    required>
                <p id="error-contraseña" style="color: red;"></p>
            </label>
            <button type="submit" id="submit-button">Cambiar Contraseña</button>
            <button type="reset" onclick="location.href='./login.html'">Cancelar</button>
        </form>

        <footer class="footer">
            Copyright © 2020 SERVICIO AUTOMOTRIZ AUTOMASTER - Todos los derechos reservados.
            <br>
            <a style="color: white; font-size: large;" href="aviso.html">AVISO DE PRIVACIDAD</a>
        </footer>


    </div>
    <script>
    const contraseñaInput = document.getElementById("Contraseña");
    const errorContraseña = document.getElementById("error-contraseña");
    const submitButton = document.getElementById("submit-button");

    submitButton.addEventListener("click", function() {
        if (!contraseñaInput.checkValidity()) {
            errorContraseña.textContent = contraseñaInput.validationMessage;
        } else {
            errorContraseña.textContent = "";
        }
    });
    </script>

</body>

</html>