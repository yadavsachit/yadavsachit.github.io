<?php 
	require_once "vendor/autoload.php";
		
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	/////////////////////////////////////////////////////////////////////////////////////////

	$conn=mysqli_connect('localhost','root','abcd','sap');
	if (!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

	$name=$_POST['name'];
	$college=$_POST['college'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$whatsapp=$_POST['whatsapp'];

	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "hritik.iitmandi@gmail.com";
	$mail->Password = "coolme#9";
	$mail->SetFrom("hritik.iitmandi@gmail.com");
	$mail->Subject = "Student Ambassador Programme";
	$mail->Body = "hello<br/><b>This is some bold text</b>";
	$mail->AddAddress($email);

	 if(!$mail->Send()) {
	 	echo '<script type="text/javascript">alert("error sending mail");</script>';
	    echo "Mailer Error: " . $mail->ErrorInfo;
	 } else {
	    echo '<script type="text/javascript">alert("message sent!");</script>';
	 }

	$sql = "INSERT INTO entry(name,college,email,contact,whatsapp)	VALUES('$name','$college','$email','$contact','$whatsapp')";
	if (mysqli_query($conn, $sql)) {
    	echo "New record created successfully";
	} 
	else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
	
?>

