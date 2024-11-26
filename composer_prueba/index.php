<?php
    require_once "vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    use tecnickcom\tcpdf\TCPDF;

    $conexionSMTP = new PHPMailer();

?>