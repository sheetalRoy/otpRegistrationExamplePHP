<?php
if(isset($_POST['btnSubmit'])){
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/incotef/mail/vendor/autoload.php');
    $email = $_POST['txtEmail'];
	 $firstname = $_POST['txtfirstname'];
	 $lastname = $_POST['txtlastname'];
	$subject = $_POST['txtSubject'];
	$name = $firstname.''.$lastname;
	// $subject = "Feedback";
	$body = $_POST['txtMsg'];
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
	->setUsername('noreply.mtuadmission@gmail.com')
	->setPassword('santikumar')
	;
	$transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));
	$mailer = new Swift_Mailer($transport);
	
	// Create a message
	$message = (new Swift_Message($subject))
	->setFrom(['noreply.mtuadmission@gmail.com' => $name])
	->setTo(['rajit@cobigent'=>'Cobigent', 'sheetal@cobigent.com' => 'My Another'])
	->setBody($body)
	;
	$msg = '';
	$success = false;
	try {
		$mailer->send($message);
		$msg = 'Message has been sent successfully.';
		$success = true;
    }
    catch (\Swift_TransportException $e) {
		$msg = 'Server is not responding!.';
		$success = false;
        echo $e->getMessage();
    }
   header("location:index.html");
    // echo $msg;

    // EF AJAX
    // $response = array(
    // 	'success' => $success,
	// 	'message' => $msg);
    // exit(json_encode($response));
}
    


?>