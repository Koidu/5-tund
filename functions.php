<?php
	// kõik AB´iga seotud
	
	function welcomeUser($name, $age){
		echo "Tere ".$name.", kelle vanus on ".$age."<br>";  //br - reavahetus ka juurde; see $name ei ole sama, mis $first_name. Võivad erinevad olla. Järjekord on oluline.
		echo $first_name;
	}  //kõik, mis on funktsiooni sees {} vahel
	echo $age;
	
	$first_name = "Juku";
	welcomeUser($first_name, 15);
	
	$first_name = "Juhan";  // see, mis liigub sulgude vahel on väärtus
	welcomeUser($first_name, 10);
?>