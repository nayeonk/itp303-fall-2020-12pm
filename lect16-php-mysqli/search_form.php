<?php 

// ----- STEP 1: Establish a DB connection
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2020!";
$db = "nayeon_song_db";


// Create an instance of mysqli class and pass in the credentials.
// When an instance is created, it automatically attempts to connect to this database with the given credentials
$mysqli = new mysqli($host, $user, $password, $db);

// Check for DB connection errors
// connect_errno will return the error code if there is an error. If no error, will return false
if($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	// Terminate the program here. No reason to continue the program if can't connect to the database.
	exit();
}


// ---- STEP 2: Generate & Submit SQL query

// Write out SQL statement as a string
$sql = "SELECT * FROM genres;";

// Echo out the SQL to see it and make sure there arent errors
echo "<hr>" . $sql . "<hr>";

// Submit this SQL query to the DB using query() method
// query() method will return results
$results = $mysqli->query($sql);

// Quickly see what was returned from query()
var_dump($results);

// Check for any SQL errors when we get results back
// query() will return fALSE if there were any errors with the query
if(!$results) {
	echo $mysqli->error;
	exit();
}


// Can make multiple queries in one
$sql_media = "SELECT * FROM media_types;";
$results_media = $mysqli->query($sql_media);

// Quickly see what was returned from query()
var_dump($results_media);

// Check for any SQL errors when we get results back
// query() will return fALSE if there were any errors with the query
if(!$results_media) {
	echo $mysqli->error;
	exit();
}


// ---- STEP 3: Display Results
echo "<hr>";
// Display number of records that were returned
echo "Number of results: " . $results->num_rows;

// fetch_assoc() : return ONE result (row) as an associative array.
echo "<hr>";
//var_dump($results->fetch_assoc());

// Run a while loop to show ALL the results
// fetch_assoc() will return false when it reaches the end of the results
// $row is a temp variable within the while loop and will store each result returned by fetch_assoc()
// while( $row = $results->fetch_assoc() ) {
// 	var_dump($row);
// 	echo "<hr>";
// }

// Cant run through the results again
// while( $row = $results->fetch_assoc() ) {
// 	var_dump($row);
// 	echo "<hr>";
// }


// ---- STEP 4: Close DB connection
$mysqli->close();

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre" id="genre-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>Rock</option>
						<option value='2'>Jazz</option>
						<option value='3'>Metal</option>
						<option value='4'>Alternative & Punk</option>
						<option value='5'>Rock And Roll</option>-->

						<?php 

							// This method works but gets messy because we are mixing html and php in one echo statement
							// while( $row = $results->fetch_assoc() ) {
							// 	echo "<option value='" . $row["genre_id"] .  "'> </option>";
							// }
						?>


						<!-- Alternative Syntax. Separates HTML and PHP. -->

						<?php while( $row = $results->fetch_assoc() ) : ?>

							<option value="<?php echo $row["genre_id"]; ?>">
								<?php echo $row["name"]; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option> -->

						<?php while( $row = $results_media->fetch_assoc() ) : ?>

							<option value="<?php echo $row["media_type_id"]; ?>">
								<?php echo $row["name"]; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>