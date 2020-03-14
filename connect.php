<?php
function saveRegistration(){
$servername = "localhost";
$username = "root";
$password = "";
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$contact = $_POST['contact'];
$company = $_POST['company'];
$designation = $_POST['designation'];
$email = $_POST['email'];
// $conn = new mysqli('192.168.0.6','sheetal','sheetal','incotef');
// if($conn->connect_error){
// 	die('Connection Failed' .$conn->connect_error);
// }else{
// 	$sql = $conn->prepare("insert into tb_registration(firstName, lastName, contact, designation, company, email)values(?,?,?,?,?,?)");
// 	$sql->bind_param("ssssss",$firstName,$lastName,$contact,$designation,$company,$email);
// 	$sql->execute();
// 	// echo "Registration Successfully";
// 	$sql->close();
// 	$conn->close();
// }
// header ("Location: registration.html");
try {
    $dt_time = new DateTime();
    $year = $dt_time->format('Y');
    $year = substr( $year, -2);
    $dt = $dt_time->format('d');
    $regid = 'MITCON'.$year.$dt;
    $conn = new PDO("mysql:host=$servername;dbname=incotef", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // to generate id 
    $idCount = $conn->query("SELECT * FROM tb_registration");
    if($idCount == '0'){
        $regid = $regid.'01';
    }else{
        if($idCount->rowCount()>9){
            $regid = $regid.'0'.($idCount->rowCount()+1);    
            
        }else{
            $regid = $regid.($idCount->rowCount()+1);
        }
    }
     
    // echo "Connected successfully";
    
    // $result = mysqli_query($conn,"SELECT * FROM tb_registration");
    // $count  = mysqli_num_rows($result);
    // echo $count;die();
    $sql = "INSERT INTO tb_registration(firstName, lastName, contact, designation, company, email, regid)VALUES(?,?,?,?,?,?,?)";
    // use exec() because no results are returned
    $conn->prepare($sql)->execute([$firstName,$lastName,$contact,$designation,$company,$email, $regid]);
    // $conn->exec($sql);

    // echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
// $jsonobj = '{"regis_id":$regid,"Success":true}';
$jsonobj = array(
    "regis_id" => $regid,
    "success" => true,
    "edition" => 6
);
    // $jsonData = json_encode($jsonobj); 
    // echo $jsonData;
    return $jsonobj;
    }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }
?>