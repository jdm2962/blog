	<?php

		session_start();
	?>


<!DOCTYPE html>
<html>
	<head>
		<title>Make a Post</title>

		<meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scal = 1">

		<!-- bulma -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<!-- custom css -->
		<link rel="stylesheet" type="text/css" href="css/custom_styles_postPage.css">
		<!-- font awsome -->
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
		

		<script type="text/javascript" src = "js/js_ajax.js"></script>
		
	</head>

	<body onload = "getUserInfo()" class = "has-background-grey">

		<section class = "section main_sec">

			<form class = "display_if_logged_in center form" method = "POST" action = "php/postDB.php">

				<!-- title -->
				<div class = "field center">
					<label class = "label is-large">Title</label>
					<div class = "control title_container">
						<input type = "text" name = "title" class = "input is-medium title is-info" required>
					</div>
				</div>

				<!-- post -->
				<div class = "field center">		
					<label class = "label is-large">Post</label>
					<div class = "control post_container">
						<textarea name = "post" class = "textarea post is-large has-fixed-size is-primary" rows = "10" required></textarea>
					</div>
				</div>

				<!-- submit -->
				<div class = "field center">
					<div class = "control submit_container center">
						<input type="submit" name="submit" value = "Post it!" class = "button is-success is-medium">
					</div>
				</div>

			</form>
		</section>

	</body>
</html>


