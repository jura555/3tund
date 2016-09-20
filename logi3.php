<?php
//ma ei leidnud viga miks mull ei tule valja sonumi kui e-post ja Full name on tuhjad, errori ka ei ole. 
//ja kuna ma ei leidnud kuhu panna oma MVP ideed siis kirjutan seda siia, et tahaks teha vaike veebi lehekulje kus naiteks minu kursuse liikmed kus on huvitanus naiteks kossu mangimises voiks valida sobiva kuupaeva ja aja et minna koos mangida, voi sama teema jousaaliga naiteks. 


//           INSERT INTO user_sample (email, password) VALUES 

require("../../config.php");

$signupGender = "";
$signupEmailError = "";
$signupPasswordError = "";
$signupNameError = "";
$signupUsernameError = "";

if( isset( $_POST["signupEmail"])) {
	if(empty($_POST["signupEmail"])){
		$signupEmailError = "email on tuhi";

	}
}

if( isset( $_POST["signupPassword"])) {
	if(empty($_POST["signupPassword"])){
		$signupPasswordError = "pass on tuhi";

	} else {
		if (strlen ($_POST["signupPassword"]) < 8 ){$signupPasswordError = "pass on luhike";}
}

		//siia juan siis kuiparool oli oleman
	
	
}




if( isset( $_POST["signupName"])) {
	if(empty($_POST["signupName"])){
		$signupNameError = "No name taped";

	}
}

if( isset( $_POST["signupUsername"])) {
	if(empty($_POST["signupUsername"])){
		$signupUsernameError = "Username not taped";

	} else {
		if (strlen ($_POST["signupUsername"]) <= 3 ){$signupUsernameError = "Username not long enought";}
}

		}

		
	//peab olema emailja parool 
    //ja uhtegi errorit 

		
	if ( $signupPasswordError == "" && empty($signupPasswordError)&&
	
		isset($_POST["signupPassword"])&&
		isset($_POST["signupEmail"])&&
		$signupEmailError == "" &&
		empty($signupPasswordError)
	) {
	echo "Salvestan... <br>";
	echo "email: ".$_POST["signupEmail"]."<br>";
	echo "password: ".$_POST["signupPassword"]."<br>";
	$password = hash("sha512", $_POST["signupPassword"]);
	echo "pasword hashed: ".$password."<br>";
	
	//echo $serverUsername;
	//uhendus
	$database = "if16_juri";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
	
//stringina uks taht iga muutujajurde (?)
//string -s
//integer - i
//float (double) - d
	
	$stmt->bind_param("ss", $_POST["signupEmail"], $password);
	if($stmt->execute()){
		echo "Salvestamie onnestus";
	} else {
		echo "ERROR ".$stmt->error;
	}
	

	
	$stmt->close();
	$mysqli->close();
	}

	
		
	
		
		
?>










<!DOCTYPE html>
<html>
<head>
<title>Logi sisse voi loo oma konto </title>
</head>
<body>

<h1>Logi sisse</h1>
<form method="POST">
    
	<label>E-post</label><br>
	<input name="signupEmail" type ="text"><br><br>
	
	
	<input name="loginpassword" placeholder ="Password" type ="password"><br><br>

	<input type ="submit">
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<title>Logi sisse voi loo oma konto </title>
</head>
<body>

<h1>Loo kasutaja</h1>
<form method="POST">
    
	<label>E-post</label><br>
	<input name="signupEmail" type ="text"><?php echo $signupEmailError; ?><br><br>
	
	    <?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Male<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="male"> Male<br>
		<?php } ?>
		
		<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked> Female<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Female<br>
		<?php } ?>
		
		<?php if($signupGender == "other") { ?>
			<input type="radio" name="signupGender" value="other" checked> Other<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="other"> Other<br>
		<?php } ?>
	
	
	<input name="signupPassword" placeholder ="Password" type ="password"> <?php echo $signupPasswordError; ?>
	<br><br>

	<input type ="submit">
</body>
</html>





<!DOCTYPE html>
<html>
<head>
<title>Name and Username </title>
</head>
<body>

<h1>Insert Name and Username</h1>
<form method="POST">
    
	<label>Full name</label><br>
	<input name="signupName" type ="text"><?php echo $signupNameError; ?><br><br>
	
	
	<input name="signupUsername" placeholder ="Username" type ="password"><?php echo $signupUsernameError; ?>
	<br><br>

	<input type ="submit">
</body>
</html>


 
