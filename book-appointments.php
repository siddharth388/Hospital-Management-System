<?php 
require_once "importance.php"; 

?> 

<html>
<head>
	<title>Book Appointment - <?php echo CONFIG::SYSTEM_NAME; ?></title>
	<?php require_once "inc/head.inc.php";  ?> 
</head>
<body>
	<?php require_once "inc/header.inc.php"; ?> 
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-md-2'><?php require_once "inc/sidebar.inc.php"; ?></div> <!-- this should be a sidebar --> 
			<div class='col-md-7'>
				<div class='content-area'> 
				<div class='content-header'> 
					Book Appointment <small>Book an appointment with a given doctor</small>
				</div>
				<div class='content-body'> 
					<div class='form-holder'><br /><br />
						<?php
						
							if(isset($_POST['p-name'])){
								$name = $_POST['p-name']; 
								$number = $_POST['p-number']; 
								$phone = $_POST['p-phone']; 
								$message = $_POST['message'];
								$doctor = $_POST['a-doctor'];
								$dateOfBirth = $_POST['p-birth'];
							
							  	// $dataBirth = explode("-", $dateOfBirth);
								
								//$dateOfBirth = preg_replace("#[^0-9-]#", "", $dataBirth[2]."-".$dataBirth[1]."-".$dataBirth[0]);

								if($message == "" || $doctor == ""){
									Messages::error("You must fill in all the fields");
								} else {
									Appointment::send($name, $number, $phone, $message, $doctor, $dateOfBirth);
								}
							}
						
							$patient = $_SESSION['patient'];
							
							$form = new Form(2, "post"); 
							$form->init(); 
							$form->textBox("Full Name", "p-name", "text", Patient::getP($patient, "name"), array("readonly") );
							$form->textBox("Patient Number", "p-number", "number", Patient::getP($patient, "number"), array("readonly") );
							$form->textBox("Phone", "p-phone", "number", Patient::getP($patient, "phone"), array("readonly"));
							$form->textBox("Date of Birth", "p-birth", "date", "$dateOfBirth", "");
							$form->textarea("Message", "message", "" );

							
							Doctor::getArray("a-doctor", 2);
							$form->close("Book Appointment");
						?>
					</div>
				</div><!-- end of the content area --> 
				</div> 
				
			</div><!-- col-md-7 --> 

			<div class='col-md-3'>
				<img src='images/OF16400.jpg' class='img-responsive' /> 
			</div> <!-- this should be a sidebar -->
				
		</div> 
	</div> 
</body>
</html>
