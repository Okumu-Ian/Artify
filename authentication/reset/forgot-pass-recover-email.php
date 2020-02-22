<?php
if(!class_exists('PHPMailer')) {
    require('../mailer/_lib/class.phpmailer.php');
	require('../mailer/_lib/class.smtp.php');
}

require_once("../../config.php");
require_once("mail_configuration.php");

$mail = new PHPMailer();


$emailBody = "<div>"
. ",<br><br><p>Click this link to recover your password<br><a href='"
. PROJECT_HOME 
. "?token="
. $token
. "'>" 
. PROJECT_HOME . "?token=" 
. $token. "&email=".$email."</a><br><br></p>Regards,<br> Admin.</div>";

$mail_body = '
    <div class="container" style="margin-bottom: 2.5%; padding:10px;">
		
	<style>
	.button {
		display: block;
		width: 115px;
		height: 25px;
		background: #4E9CAF;
		padding: 10px;
		text-align: center;
		border-radius: 5px;
		color: white;
		font-weight: bold;
	}
	</style>

        <div class="row justify-content-center">
        <h2 class="form-title" >Artify</h2>   
        </div>
        
        <div class="row justify-content-center">
        <h4 class="form-title">Reset Your Password</h4>
        </div>

        <div class="row container">

            <h4>You are receiving this email because you have requested a password reset.</h4>
            <p>If it was not you who requested it, Ignore this email.</p>

			<a href="
			'.PROJECT_HOME
			.'?token='
			.$token
			.'&email='
			.$email
			.'
			" class="button">Reset Password</a>

        </div>


    </div>
</body>

</html>';

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = PORT;  
$mail->Username = MAIL_USERNAME;
$mail->Password = MAIL_PASSWORD;
$mail->Host     = MAIL_HOST;
$mail->Mailer   = MAILER;

$mail->From = SENDER_EMAIL;
$mail->FromName = SENDER_NAME;
$mail->AddReplyTo(SENDER_EMAIL, SENDER_NAME);
$mail->ReturnPath=SENDER_EMAIL;	
$mail->AddAddress($email);
$mail->Subject = "Forgot Password Recovery";		
$mail->MsgHTML($mail_body);
$mail->IsHTML(true);


if(!$mail->Send()) {
	$error_message = 'Problem in Sending Password Recovery Email';
} else {
	$success_message = 'Please check your email to reset password!';
	$query_insert_token = "INSERT into reset_pass(email,token) VALUES('$email','$token')";
	mysqli_query($con,$query_insert_token);
}

?>