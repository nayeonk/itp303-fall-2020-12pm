<?php

var_dump($_POST);

// You should always have server-side validation even if front-end validation exists because front-end validation can be disabled or tampered with.
// Double check that user has filled out all required input
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {

	$error = "Please fill out all required fields.";
}
else {
	// connect to the db!
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$password = "uscItp2020!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $password, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// If optional fields are not filled out, make it add as "null"
	if( isset($_POST["album"]) && !empty($_POST["album"])) {
		// User selected an album
		$album_id = $_POST["album"];
	}
	else {
		$album_id = "null";
	}
	if( isset($_POST["composer"]) && !empty($_POST["composer"])) {
		// User typed in a composer
		$composer = "'" . $_POST["composer"] . "'" ;
	}
	else {
		$composer = "null";
	}
	if( isset($_POST["bytes"]) && !empty($_POST["bytes"])) {
		// User typed in bytes
		$bytes = $_POST["bytes"];
	}
	else {
		$bytes = "null";
	}

	// real_escape_string() escapes certain characters such as single quotes, double quotes, end of line characters, etc that causes problems when inserted into a SQL statement.
	$track_name = $mysqli->real_escape_string($_POST["track_name"]);
	

	// Write out the SQL
	$sql = "INSERT INTO tracks(name, album_id, media_type_id, genre_id, composer, milliseconds,bytes, unit_price)
		VALUES('" . $track_name . "'," 
		. $album_id . " ,"
		. $_POST["media_type"] . " , "
		. $_POST["genre"] .","
		. $composer . ","
		. $_POST["milliseconds"] . ", " 
		. $bytes . ", " 
		. $_POST["price"] . ");";

	// Lots of string concatenation here so double check SQL looks good
	echo "<hr>" . $sql . "<hr>"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// To double check INSERT was succesful, echo out $mysqli->affected_rows. affected_rows contains the number of rows that have been inserted, updated or deleted by the SQL command

	echo "Inserted: " . $mysqli->affected_rows;

	if( $mysqli->affected_rows == 1 ) {
		$isInserted = true;
	}

	$mysqli->close();
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<!-- Show error message if user did not fill out any of the required fields -->
			<?php if( isset($error) && !empty($error)) :?>
				<div class="text-danger">
					<?php echo $error;?>
				</div>
			<?php endif;?>


			<?php if( isset($isInserted)) :?>
				<div class="text-success">
					<span class="font-italic"><?php echo $_POST["track_name"]; ?></span> was successfully added.
				</div>
			<?php endif;?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>