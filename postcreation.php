	<?php

		session_start();
	?>


<!DOCTYPE html>
<html class = "has-background-grey">
	<head>
		<title>Make a Post</title>

		<meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scal = 1">

		<!-- bulma -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<!-- trix -->
		<link rel="stylesheet" type="text/css" href="trix/dist/trix.css">
		<script type="text/javascript" src="trix/dist/trix.js"></script>
		<!-- custom css -->
		<link rel="stylesheet" type="text/css" href="css/custom_styles_postPage.css">
		<!-- font awsome -->
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
		

		<script type="text/javascript" src = "js/js_ajax.js"></script>
		<script type="text/javascript" src = "js/js_ajax.js"></script>
		
	</head>

	<body onload = "getUserInfo()" class = "center">


		<form class = "display_if_logged_in has-background-white-ter is-primary" method = "POST" action = "php/postDB.php" id = "post_form">

			<!-- title -->
			<div class = "field center" id = "title_container">
				<label class = "label is-large">Title</label>
				<div class = "control">
					<input type = "text" name = "title" class = "input title is-info" required placeholder = "Enter Post Title!">
				</div>
			</div>

			<!-- post -->
			<div class = "field" id = "post_container">	
				<label class = "label is-large">Post</label>
				<div class = "control" id = "post_control">

					<!-- <input id="x" value="Editor content goes here" type="hidden" name="content" input = "hidden_input">

					<trix-editor class = "trix-content" id = "trix_content"></trix-editor> -->

					<input id="x" value="Editor content goes here" type="hidden" name="content">
  					<trix-editor input="x" class = "trix-content"></trix-editor>

					<div class="trix-content">Stored content here</div>
				</div>
			</div>

			<!-- submit -->
			<div class = "field center" id = "submit_container">
				<div class = "control submit_container center">
					<input type="submit" name="submit" value = "Post it!" class = "button is-success is-medium">
				</div>
			</div>

		</form>

	</body>
</html>


