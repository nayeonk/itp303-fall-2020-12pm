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

	// 4. Three ways that we have learned so far on how to output information. First is var_dump(). Show on console - it shows data type as well. NEXT: display this on the browser, back to frontend.html.

	//var_dump("Hello world!");

	// 6. echo is also used to output HTML. Comment out var_dump() above. Refresh. Browser will show Hello World now.
	// echo "Hello World!";

	// 7. Classic return statement. Comment out echo above. Shows nothing :( the ajax call only returns string.
	// return "Hello World";

	// 8. However, with web applications we are not going to get back a simple string. It's gonna be a bunch of data, probably an associative array that looks like the one on top given to you. Try just echoing at first. Going to have errors b/c cant echo out arrays.

	// echo $php_array;

	// 9. Can't just display an array. Need to do some kind of conversion so that browser can somehow read it. Anyone guess what format we can convert to? To convert associative array to a JSON formatted string, use json_encode().

	// echo json_encode($php_array);

	// 10. That means we can use dot notation to grab values, right? NEXT: Go back to ajaxGet() in frontend.html and try dot notation. 


	// 15. Show that we got the paramenters. So you can see where we are going with this. When user types in a search term, we can grab it using $_GET (an associative array) just like what we have done with PHP before. Then run a SQL query to grab the results we want. But before we do that, let's also cover POST requests. NEXT: back to frontend.html to create a POST request.
	// echo json_encode($_GET);


	// 21. Verify POST is working. Now that those cases are covered, let's finish our demo here. This is a simple search, no sensitive data sent, so a GET request will be sufficient. NEXT: back to frontend.php to handle the form submission.
	// echo json_encode($_POST);


	// 25. Comment echo statements before. Connect to the database.
	$host = "303.itpwebdev.com";
	$user = 'nayeon_db_user_5';
	$pass = 'uscItp2018';
	$db = 'nayeon_song_db_default';

	$mysqli = new mysqli($host, $user, $pass, $db);
	// error checking here. omitted for time sake.
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// 26. SELECT statement, pass in the search term
	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $_GET['term'] . "%' LIMIT 10;";

	$results = $mysqli->query($sql);
	// check for errors.
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();


	// 27. At this point, we would run a while loop, use fetch_assoc() and etc. But we need to give this data back to the frontend, so let's store all this in an array.

	$results_array = [];

	while( $row = $results->fetch_assoc() ) {
		array_push( $results_array, $row );
	} 

	// 28. Convert the assoc array into a json string. This string going to be converted to JSON objects. Back to frontend.html to see the results in console log. Try a couple more searches to show that no page refresh is required. NEXT: back to frontend.php to display the results.
	echo json_encode( $results_array );

?>