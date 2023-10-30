<?PHP
require 'metodosusuario.php';

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/PHPMailer.php';
require 'PHPMailer-master/SMTP.php';
require 'PHPMailer-master/Exception.php';

$correElectronico = $_POST['CorreoElectronico'];

$cifradocorreo = md5($correElectronico);
$resultado = Consulta_usuario_email($cifradocorreo);
if (!$resultado) {
    echo ("<script>alert('No existe el correo electronico favor de verificarlo')</script>");
    echo ("<script>location.href='../recuperacion.html'</script>");
} else {
    $row = $resultado->fetch_assoc();
    $mail = new PHPMailer(true);
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'AutoMastersOfficial@outlook.com';                     //SMTP username
    $mail->Password   = 'Taller1234';                               //SMTP password
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('AutoMastersOfficial@outlook.com', 'AutoMasters');
    $mail->addAddress($correElectronico, 'Joe User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperacion de contraseña';
    $mail->Body    = 'Hola este es un correo electronico para el reestablecimiento detu contraseña <a href="http://localhost/tallermecanico/cambio_contraseña.php?id=' . $row['Id'] . '">clic aqui</a> para recuperar tu contraseña';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script>alert("Favor revisa tu correo electronico para seguir con el proceso de recuperación de tu cuenta")</script>';
    echo '<script>alert("En caso de no encontrar el correo electronico favor de revisar en spam")</script>';
    echo "<script>location.href='../login.html'</script>";
}
