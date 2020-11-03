<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];
	// Whatever is echoed out is sent to the frontend
	// One limitation with echo is that you can only echo out strings.
	// echo "hello";
	// echo $php_array;

	// Convert php assoc array into a JSON string so that the frontend can use it
	//echo json_encode($php_array);

	//echo json_encode($_POST);

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2020!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $_GET["term"] . "%' LIMIT 10;";

	//echo $sql;
	//echo "<hr>";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$results_array = [];

	while( $row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Convert the assoc array to json string
	echo json_encode($results_array);


	$mysqli->close();


?>










