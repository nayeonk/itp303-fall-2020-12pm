<?php

// if config.php file is not found, it will terminate the program
require "config/config.php";

// This page must have a track_id appended to its URL. Otherwise this page won't know which track to display.
if( !isset($_GET["track_id"]) || empty($_GET["track_id"])) {

	echo "Invalid track ID";
	exit();

}

// Move out my credentials to another file (config/config.php) and use require keyword to "import" them in

// $host = "303.itpwebdev.com";
// $user = "nayeon_db_user";
// $pass = "uscItp2020!";
// $db = "nayeon_song_db";

// DB Connection.
// Use the constants declared in config/config.php for credentials 
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

// -- Get details of this track
$sql = "SELECT * FROM tracks
WHERE track_id = " . $_GET["track_id"] . ";";

$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}

// Only one result will be returned since we are looking up details of just ONE track
$row = $results->fetch_assoc();

// double check we got the correct results
var_dump($row);

// Genres:
$sql_genres = "SELECT * FROM genres;";
$results_genres = $mysqli->query($sql_genres);
if ( $results_genres == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection
$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Form | Song Database</title>
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
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php">Details</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="edit_confirmation.php?" method="POST">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">
					Track Name: <span class="text-danger">*</span>
				</label>
				<!-- Value attribute is what is typed in the text box. It is editable. Using value we can pre-fill the song information -->
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name" value="<?php echo $row['name'] ?>">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">
					Genre: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">

<!-- While running through all the genre results, if one of the genres matches this track's genre, add the "selected" attribtue to that option tag  -->
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected disabled>-- Select One --</option>

	<?php while( $row_genre = $results_genres->fetch_assoc() ): ?>

		<?php if( $row_genre["genre_id"] == $row["genre_id"] ): ?>
			
			<option selected value="<?php echo $row['genre_id']; ?>">
				<?php echo $row_genre['name']; ?>
			</option>

		<?php else: ?>

			<option value="<?php echo $row['genre_id']; ?>">
				<?php echo $row_genre['name']; ?>
			</option>

		<?php endif;?>

	<?php endwhile; ?>

</select>

				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="composer-id" class="col-sm-3 col-form-label text-sm-right">
					Composer:
				</label>
				<div class="col-sm-9">
					<input type="text" name="composer" id="composer-id" class="form-control" value="<?php echo $row['composer']; ?>">
				</div>
			</div> <!-- .form-group -->

			<!-- input type="hidden" will hide this info, but this info will still get sent over to edit_confirmation.php -->
			<input type="hidden" name="track_id" value="<?php echo $_GET['track_id']; ?>">

			<div class="form-group row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>