<?php
	// laeme funktsiooni failis
	require_once("functions.php");
	
	// kontrollin, kas kasutaja on sisse loginud
	if(isset($_SESSION["id_from_db"])){
			// suunan data.php lehele
			header("Location: data.php");
	}
	
	
	
    
  // muuutujad errorite jaoks
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";
  // muutujad v��rtuste jaoks
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){
			if ( empty($_POST["email"]) ) {
				$email_error = "See v�li on kohustuslik";
			}else{
        // puhastame muutuja v�imalikest �leliigsetest s�mbolitest
				$email = cleanInput($_POST["email"]);
			}
			if ( empty($_POST["password"]) ) {
				$password_error = "See v�li on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}
      // Kui oleme siia j�udnud, v�ime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "V�ib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
				
				$password_hash = hash("sha512", $password);
				
				loginUser ($email, $password_hash);			
							
				
			}
		} // login if end
    // *********************
    // ** LOO KASUTAJA *****
    // *********************
    if(isset($_POST["create"])){
			if ( empty($_POST["create_email"]) ) {
				$create_email_error = "See v�li on kohustuslik";
			}else{
				$create_email = cleanInput($_POST["create_email"]);
			}
			if ( empty($_POST["create_password"]) ) {
				$create_password_error = "See v�li on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$create_password_error = "Peab olema v�hemalt 8 t�hem�rki pikk!";
				}else{
					$create_password = cleanInput($_POST["create_password"]);
				}
			}
			if(	$create_email_error == "" && $create_password_error == ""){
				echo "V�ib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password;
				
				$password_hash = hash("sha512", $create_password);
				echo "<br>";
				echo $password_hash;

				
				// echo $mysqli ->error;
				// echo $stmt->error;
				createUser ($create_email, $password_hash);
				
			
	 }
    } // create if end
	}
  // funktsioon, mis eemaldab k�ikv�imaliku �leliigse tekstist
  function cleanInput($data) {
  	$data = trim($data); //v�tab �ra t�hjad enterid, t�hikud ja tab�is
  	$data = stripslashes($data); // v�tab �ra vastupidised kaldkriipsud ehk \
  	$data = htmlspecialchars($data); // muudab tekstiks
  	return $data;
  }
  
  
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br>
  	<input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Log in">
  </form>

  <h2>Create user</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
  	<input type="submit" name="create" value="Create user">
  </form>
<body>
<html>
