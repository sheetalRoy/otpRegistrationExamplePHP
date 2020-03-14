<?php 
 function sendOTPsdf($email,$otp) {
  // require('phpmailer/class.phpmailer.php');
  // require('phpmailer/class.smtp.php');
  // mail('shtlroy6@example.com', 'My Subject', "sjdk");
  $message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
  $mail = new PHPMailer();
  echo 'sadf';

  // $mail->IsSMTP();
  // $mail->SMTPDebug = 0;
  // $mail->SMTPAuth = TRUE;
  // $mail->SMTPSecure = 'tls'; // tls or ssl
  // $mail->Port     = "587";
  // $mail->Username = "shtlroy6@gmail.com";
  // $mail->Password = "Cobi@2016";
  // $mail->Host     = "your-host";
  // $mail->Mailer   = "smtp";
  // $mail->SetFrom("your-mail-address", "web");
  // $mail->AddAddress($email);
  // $mail->Subject = "OTP to Login";
  // $mail->MsgHTML($message_body);
  // $mail->IsHTML(true);  
  // $result = $mail->Send();
  // return $result;
 }
 function sendOTP($email,$otp) {
 require_once 'swiftmailer-master/lib/swift_required.php'; // importing required third party's file to be used

        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                ->setUsername('shtlroy6@gmail.com') // here please put your mail username eg abcde@gmail.com
                ->setPassword('Cobi@2016'); // put ypur password here
                echo 444;die();
        $mailer = Swift_Mailer::newInstance($transport);
        $message = Swift_Message::newInstance('THIS IS THE SUBJECT')
                ->setFrom(array('shtlroy6@gmail.com' => 'SENDER NAME')) // sender email id
                ->setTo(array('sheetal@cobigent.com' => 'YOU')) //Recipient email id
                ->setBody('This is the text of the mail send by Swift using SMTP transport.'); //mail body
        // $attachment = Swift_Attachment::newInstance(file_get_contents('File/maxresdefault.jpg'), 'maxresdefault.jpg'); // file name with file path to attached
        // $message->attach($attachment);
                // echo 777;die();
        $numSent = $mailer->send($message);
        echo "asdf";
        // printf("Sent %d messages\n", $numSent); //status message
      }
      function sendMobile($mobile,$otp) {
        echo $mobile;die();
//         $username="xtraEdge";

//         $password="4667920";

//         $message= $otp;

//         $sender="XESCHL"; //ex:INVITE

//         $mobile_number="9856905524";

//       $url="bulksms.malang.net.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."
//       &mobile=".urlencode($mobile_number)."&message=".urlencode($message)."&sender=".urlencode($sender)."&type=".urlencode('3');
// $ch = curl_init($url);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $curl_scraped_page = curl_exec($ch);

// curl_close($ch);
// $res = json_decode($curl_scraped_page, true);
// echo 'Send';


  $mobile = $mobile;
  $message = "Your OTP no is ".$otp." for MIDCON registration";
  $api_username = "cobigent";
  $api_password = "cob123";
  $sender = "FOREST";
  $type = "TEXT";
  $message = urlencode($message);

  $apiUrl ="https://app.indiasms.com/sendsms/bulksms.php";
  $url =$apiUrl."?username=".$api_username."&password=".$api_password."&type=".$type."&sender=".$sender."&mobile=".$mobile."&message=".$message;

  if( function_exists("curl_init")){
    $ch = curl_init();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
    curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 0 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    $response = curl_exec ( $ch );
    curl_close($ch);
  }else{
    $return_val = file($url);
    $response = $return_val[0];
  }

  list($send,$msgcode) = explode("|",$response);
  if (trim($send) == "SUBMIT_SUCCESS") {
    echo "Sent SMS successfully.";
  }else{
    echo "Unable to Send SMS successfully.";
      }
    }
?>