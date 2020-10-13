<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

			<div class="col-12">
				<!-- Display Test Output Here -->

<?php
	// Display (aka print) anythnig
	echo "Hello World!";
	echo 5;
	echo "<strong>Hi</strong>";
	echo "<hr>";

	// Variables
	$name = "Tommy";
	$age = 21;

	echo $name;
	echo "<hr>";

	// Concatenation - in JS we used + to concatenate strings. In PHP it's . (period)

	echo "My name is " . $name;

	// With double quotes you can utilize variable interpolation

	echo "<hr>";
	echo "My name is $name";

	// However, can't do it with single quote
	echo "<hr>";
	echo 'My name is $name';

	echo "<hr>";
	echo "double quotes can do escape characters \" \' ";

	// Date/time in PHP
	// Set the timezone
	date_default_timezone_set("America/Los_Angeles");

	echo "<hr>";

	// Includes formating. E.g. 10-13-2020 1:07:00 PDT
	echo date("m-d-Y g:i:s T");

	// Arrays and loops
	$colors = ["red", "blue", "green"];

	echo "<hr>";
	echo $colors[0];

	echo "<hr>";
	for( $i = 0; $i < sizeof($colors); $i++) {
		echo $colors[$i] . ", " ;
	}


	// Associative arrays: arrays but with string keys instead of numerical keys

	$courses = [
		"ITP 303" => "Full-Stack Web Development",
		"ITP 404" => "Advanced Front-End Web Development",
		"ITP 405" => "Advanced Back-End Web Development"
	];

	echo "<hr>";
	// Normal arrays you access with integers, like $colors[0] but assoc arrays you access with the STRING keys
	echo $courses["ITP 303"];

	// Foreach loops are useful in iterating through assoc. arrays
	echo "<hr>";
	// $courses is name of assoc. array
	// $courseNumber is temp variable for the KEY
	// $courseName is temp variable for the VALUE
	foreach($courses as $courseNumber => $courseName) {
		echo $courseNumber . ": " . $courseName;
		echo "<br>";
	}

	echo "<hr>";
	// This is also common, loop through assoc array and print out just the VALUES
	foreach($courses as $courseName) {
		echo $courseName;
		echo "<br>";
	}

	echo "<hr>";
	// cannot echo out strings
	// echo $courses;

	// Using var_dump is helpful to quickly see what's in a variable. Especialy helpful because echo can only display strings.
	// var_dump tells you the variable's data type and its value
	var_dump($courses);

	// Older syntax to create arrays
	$numbers = array(1,2,3,4);


	// ---- SUPERGLOBALS
	echo "<hr>";

	var_dump($_SERVER);
	echo "<hr>";

	echo $_SERVER["HTTP_HOST"];

	echo "<hr>";
	echo "<strong>GET superglobal:</strong> ";
	var_dump($_GET);

	echo "<hr>";
	echo "<strong>POST superglobal:</strong> ";
	var_dump($_POST);




?>

			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["name"]) && !empty($_POST["name"])) {
						echo $_POST["name"];
					}
					else {
						echo "Name is empty";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["email"]) && !empty($_POST["email"])) {
						echo $_POST["email"];
					}
					else {
						echo "Email is empty";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php 
					foreach($_POST['subscribe'] as $subscribe) {
						echo $subscribe . ", ";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>