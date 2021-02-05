<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class cliente {
    //estado
    private $nombre;
    private $apellidos;
    private $dni;
    private $email;
    private $fecha_nac;
    
    //comportamiento
    function __construct($nombre,$apellidos,$dni,$email,$fecha_nac) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->email = $email;
        $this->fecha_nac = $fecha_nac;
    }
    
    function darAlta($conn){
        $sql = "insert into clientes (nombre,apellidos,dni,email,fecha_nac) values ('".$this->nombre."','".$this->apellidos."','".$this->dni."','".$this->email."','".$this->fecha_nac."');";
        if ($conn->query($sql) == true){
            echo "Nueva entrada creada";
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'tiendaasir960@gmail.com';                     // SMTP username
                $mail->Password   = 'frodobolson';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress("$this->email");     // Add a recipient
                $mail->addReplyTo('tiendaasir960@gmail.com', 'Information');
                $mail->addCC('tiendaasir960@gmail.com');
                $mail->addBCC('tiendaasir960@gmail.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Registro tienda web';
                $mail->Body    = 'Gracias por confiar en nosotros';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                echo 'Mensaje enviado';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: ".$sql." ".$conn->error;
        }
    }
    
    function buscar($filtro,$busqueda,$conn){
        $sql = "select * from clientes where $filtro like '%$busqueda%';";
        $registro = $conn->query($sql);
        if ($conn->query($sql) == true){
            echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Fecha de nacimiento</th>
            </tr>";
            if ($registro->num_rows > 0) {
                // output data of each row
                while($registro = $registro->fetch_assoc()) {
                    echo "<tr>"
                    . "<td>" . $registro["nombre"]. "</td>"
                    . "<td>". $registro["apellidos"]."</td>"
                    ."<td>".$registro["dni"]. "</td>"
                    ."<td>".$registro["email"]. "</td>"
                    ."<td>".$registro["fecha_nac"]. "</td>"
            . "</tr>";
                }
            } else {
                echo "0 results";
            }
            echo "</table>";
        } else {
            echo "Error: ".$sql.$conn->error;
        }
    }
}

class envioEmail { 
    private $mail;

    function sendMail() {
        //Crear un objeto nuevo email
        $mail = new PHPMailer();

        //Usamos SMTP
        $mail->isSMTP();

        //Permitir SMTP debugging
        // SMTP::DEBUG_OFF = off (Cuando el software esté en producción)
        // SMTP::DEBUG_CLIENT = Mensajes sólo clientes
        // SMTP::DEBUG_SERVER = Mensajes de clientes y servidor 
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        //Asignamos el servidor
        $mail->Host = 'smtp.gmail.com';
        // usar
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // Si tu red no soporta ipV6

        //Asignar el número de puerto SMTP  - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Asignar el mecanismo de encriptación - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Activamos comunicación segura SMTP authentication
        $mail->SMTPAuth = true;

        //Usuario que se logea en gmail - hay que usar la misma dirección de email completa
        $mail->Username = 'tiendaasir690@gmail.com';

        //Contraseña de gmail para la SMTP authentication
        $mail->Password = 'frodobolson';

        //Asignar el 'desde'
        $mail->setFrom('tiendaasir690@gmail.com', 'First Last');

        // reply-to address
        $mail->addReplyTo('replyto@example.com', 'First Last');

        //Dirección de envío
        $mail->addAddress($this->mail, 'John Doe');

        //Ponemos el asunto
        $mail->Subject = 'PHPMailer GMail SMTP test';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->msgHTML("<p>Este es el mensaje que leera el cliente...</p>", __DIR__);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }
    }

}

?>
