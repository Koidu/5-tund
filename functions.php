<?php
	// kõik AB´iga seotud
	
	// NÄIDE // 
	// function welcomeUser($name, $age){
		// echo "Tere ".$name.", kelle vanus on ".$age."<br>";  //br - reavahetus ka juurde; see $name ei ole sama, mis $first_name. Võivad erinevad olla. Järjekord on oluline.
		// echo $first_name;
//	}  //kõik, mis on funktsiooni sees {} vahel
	// echo $age;
	
//	$first_name = "Juku";
//	welcomeUser($first_name, 15);
	
//	$first_name = "Juhan";  // see, mis liigub sulgude vahel on väärtus
//	welcomeUser($first_name, 10);

	require_once("../configglobal.php");
	$database = "if15_koidkan";
	
		
	// lisame kasutaja andmebaasi

	function createUser(){
		
		$mysqli = new mysqli($servername, $server_username, $server_password, $database);
		// asendame ?-märgid muuttujate väärtustega
		// ss - s t2hendab string iga muutuja kohta
		$stmt->bind_param("ss", $create_email, $password_hash);
		$stmt->execute();
		$stmt->close();		
		
		$mysqli->close();
		
	}
	
	// logime sisse
	function loginUser(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"],  $GLOBALS["server_password"],  $GLOBALS["database"]);
		
		$stmt=$mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password_hash);
				
		// paneme vastuse muutujatesse
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
				
		if($stmt->fetch()){
			echo "kasutaja id=".$id_from_db;
		} else{
				echo"Wrong password or email!";
			}
			$stmt->close();
			
			$mysqli->close();
	}

?>