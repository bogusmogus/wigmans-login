<?php
    // Functie: programma login OOP 
    // Auteur: willemdaniel

    // Initialisatie
?>

<!DOCTYPE html>

<html lang="en">

<body>

	<h3>PDO Login and Registration</h3>
	<hr/>

	<h3>Welcome op de HOME-pagina!</h3>
	<br />
	<?php

    require_once 'classes/user.php';

	// Activeer de session
	session_start();

	// Check if user session has been set
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		$user = new User();
	}

	// Indien Logout geklikt
	if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
		$user->Logout();
	}

	// Check login session: staat de user in de session?
	if(!$user->IsLoggedin()){
		// Alert not login
		echo "U bent niet ingelogd. Login in om verder te gaan.<br><br>";
		// Toon login button
		echo '<a href = "login_form.php">Login</a>';
	} else {
		
		// select userdata from database
		$user->GetUser($user->username);
		
		// Print userdata
		echo "<h2>Het spel kan beginnen</h2>";
		echo "Je bent ingelogd met:<br/>";
		$user->ShowUser();
		echo "<br><br>";
		$url = "index.php?logout=true";
		echo "<a href = '". $url ."'>Logout</a>";
		//Previous line doesn't work, so this
		//$user->Logout();
	}
	
	?>

</body>
</html>