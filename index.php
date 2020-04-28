<?php

	// start session
	session_start();

?>

<?php

	include "../../inc/dbinfo.inc";
	include "php/db_functions.php";
?>

<?php

	// handle to db
	$handle = getDB("real_blogDB");

	// query for table data
		// load hero title, subtitle; about title, about description
	$sql = "SELECT title, subtitle FROM heroTable WHERE id = 1";
	$result = $handle -> query($sql);
	$row = $result -> fetch_row();

?>


<!DOCTYPE html>
<html>
<head>
	<title>A Blog</title>
	<meta charset="utf-8">
	<meta name = "viewport" content = "width = device-width, initial-scale = 1">
	<!-- bulma -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="css/custom_styles_index.css">
	<!-- font awsome -->
	<script src="https://kit.fontawesome.com/977fbb6c45.js" crossorigin="anonymous"></script>

	<script src = "js/js_ajax.js"></script>
	<script src = "js/js_lib.js"></script>

	
</head>
<body>

	<!-- TODO -->
	<!-- link to post creation page for blog owner -->
	<!-- TODO -->
	<!-- logout button for blog owner -->

	<section class = "section main_sec">

		<!-- <div class = "display_if_logged_in"><a href = 'postcreation.php' class = "button is-warning is-large">New Post</a></div> -->
			
		<section class="hero is-bold is-medium center" id = "hero">
		  <div class="hero-body">
		    <div class="container" id = "titleContainer">
	    	<!-- edit button -->
				<div class = "display_if_logged_in">
					<div id = "hero_edit_button">
						<button class = "button is-warning" onclick = "openHeroModal()">
							<span class = "icon">
								<i class="fas fa-edit"></i>
							</span>
						</button>
					</div>
				</div>
		      <h1 class="title blog_title" id = "hero_title">
		        <?php echo htmlentities($row[0], ENT_QUOTES | ENT_HTML401, "UTF-8"); ?>
		      </h1>
		      <h2 class="subtitle blog_subtitle" id = "hero_subtitle">
		        <?php echo htmlentities($row[1], ENT_QUOTES | ENT_HTML401, "UTF-8"); ?>
		      </h2>
		    </div>
		  </div>
		</section>

		<!-- hero edit modal -->
		<div class="modal" id = "hero_modal">
		  <div class="modal-background" onclick = "closeHeroModal()"></div>
		  <div class="modal-content">
		    <!-- Any other Bulma elements you want -->

		    <form class = "container has-background-white-ter" id = "hero_modal_form">

		    	<!-- hero title -->
		    	<div class="field">
		    	  <div class = "contianer color_input_container">
			    	  <label class = "label is-medium">Blog Title</label>
					  <div class="control">
					    <input class="input is-primary" type="text" placeholder="Enter Blog Title!" name="heroTitle" id = "h_blog_title_in">
					  </div>
				    </div>


					  <!-- title color -->
					  <div class = "contianer color_input_container" id = "title_color">
				    	  <label class = "label">Title Color</label>
						  <div class="control">
						   	<input type="color" name="color" id = "title_color_in">
						  </div>
					   </div>


				</div>
		    	
				<!-- subtitle -->
		    	<div class="field">
		    	  <div class = "contianer color_input_container">
			    	  <label class = "label is-medium">Subtitle</label>
					  <div class="control">
					    <input class="input is-primary" type="text" placeholder="Enter Subtitle!" name="heroSubtitle" id = "h_blog_subtitle_in">
					  </div>
				  </div>

				  <!-- subtitle color -->
				  <div class = "contianer color_input_container" id = "subtitle_color">
			    	  <label class = "label">Subtitle Color</label>
					  <div class="control">
					   	<input type="color" name="color" id = "subtitle_color_in">
					  </div>
				   </div>
				</div>

		    	<!-- color -->
		    	<div class = "container" id = "color_colorPrev">

		    		<!-- color 1 input -->
			    	<div class="field center" id = "color_in">
			    		<!-- bg color -->
				    	  <label class = "label">BG Color</label>
						  <div class="control center">
						   	<input type="color" name="color" id = "hero_color1">
					  	  </div>

					  <!-- color2 input -->
					  <label class = "label">Optional Gradient</label>
					  <div class="control center">

					  	 <!-- optional color selection -->
						  <div class="control" id = "radio_optional_color">
							  <label class="radio">
							    <input type="radio" name="answer">
							    Yes
							  </label>
							  <label class="radio">
							    <input type="radio" name="answer">
							    No
							  </label>
							</div>
							
							<!-- input -->
					   	<input type="color" name="color" id = "hero_color2">
					  </div>
					</div>

					<!-- preview -->
					<div class = "container" id = "color_preview_container">
						<label class = "label is-medium">Preview</label>
						<div class = "center" id = "color_preview">
							<div class = "container center">
								<h1 class = "title" id = "title_preview">Title</h1>
								<h2 class = "subtitle" id = "subtitle_preview">Subtitle</h2>
							</div>
						</div>
					</div>
				</div>

				<!-- hero sumbit -->
				<div class="field">
				  <div class="control center">
				   	<input type="submit" class = "button is-primary" name="submit_hero_form" id = "submit_hero_form" value = "Submit!">
				  </div>
				</div>
		    	

		    </form>
		  </div>
		  <button class="modal-close is-large" aria-label="close" onclick = "closeHeroModal()"></button>
		</div>



		<div class = "container" id = "buttonBar">
			<!-- link to login page -->
			<div class = "btn">
				<a class = "button is-warning is-large btn" href = "/blog/login.php">Login</a>
			</div>
			<div class = "display_if_logged_in btn">
				<a class = "button is-warning is-large" href="/blog/postcreation.php">New Post</a>
			</div>
			<div class = "display_if_logged_in btn" id = "logout">
				<button class = "button is-warning is-large" id = "lgout">Logout</button>
			</div>
		</div>
	
		
		<div class="columns columns_style">
			<div class="column is-two-thirds">
				<section class = "section blog_container center">
					<?php

						// load posts from database
						$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, "real_blogDB");
						if (!isset($handle))
						{
							die("Error connecting: " . $handle -> connect_error);
						}
						else
						{
							// echo "Connected!";
						}

						$sql = "SELECT * FROM BlogPost";
						$result = $handle -> query($sql);

						if ($result -> num_rows > 0)
						{
							// echo "got stuff";
							while($row = $result -> fetch_assoc())
							{


								echo '<section class = "section card_post">';
								echo 	'<div class = "card has-background-white-ter">';
								echo		'<div class = "card-header center">';
								echo			'<h3 class = "title">' .
													htmlentities($row["title"], ENT_QUOTES | ENT_HTML401, "UTF-8") .
												'</h3>';
								echo		'</div>';

								echo		'<div class = "card-content">';
								echo			'<time datetime="2016-1-1">' .
													$row["date"] .
												'</time>';
								echo			'<div class = "content is-size-5">' .
													htmlentities($row["post"],  ENT_QUOTES | ENT_HTML401, "UTF-8") .
												'</div>'; 
								echo		'</div>';
								echo	'</div>';
								echo '</section>';


							}
						}
						else
						{
							// echo "Didn't get that there!";
						}


						$handle -> close();

					?>
				</section>
			</div>

			<!-- About Section -->

			<?php 
				$handle = getDB("real_blogDB");
				$sql = "SELECT title, description FROM aboutTable WHERE id = 1";
				$result = $handle -> query($sql);
				$row = $result -> fetch_row(); 
			?>

			<div class = "column is-one-third">
				<!-- <section class = "section  about_self has-background-white-ter"> -->
					<div class = "container center about_self has-background-white-ter">

						<!-- title -->
						<h3 class = "title" id = "title">
							<?php echo htmlentities($row[0], ENT_QUOTES | ENT_HTML401, "UTF-8"); ?>
						</h3>

						<!-- edit button -->
						<div class = "display_if_logged_in edit_button" id = "edit_button">
							<button class = "button is-warning" onclick = "openModal()">
								<span class = "icon">
									<i class="fas fa-edit"></i>
								</span>
							</button>
						</div>

						<!-- image -->
						<figure class = "image is-128x128" id = "about_image_container">

							<!-- load image -->
							<?php
								//get image 
								$dirName = "/var/www/html/blog/php/img";
								$dir = new DirectoryIterator($dirName);

								foreach($dir as $file)
								{
									if(!$file -> isDot())
									{
										// echo "$file<br>";
										if(getimagesize($file -> getPath() . "/" . $file))
										{
											echo "<img  class = 'is-rounded avatar_img'src = php/img/" . $file .">";
										}
										else
										{
											// echo "Didn't get it";
										}
									}
								}
							?>
						</figure>

						<!-- description -->
						<p class = "container" id = "description">
							<?php echo htmlentities($row[1], ENT_QUOTES | ENT_HTML401, "UTF-8"); ?>		
						</p>

						<!-- social media bar -->
						<div class = "container" id = "social_media_bar">
							<a class = "button is-link">
								<span class = "icon">
									<i class="fab fa-facebook"></i>
								</span>
							</a>
							<a class = "button is-danger">
								<span class = "icon">
									<i class="fab fa-instagram"></i>
								</span>
							</a>
							<a class = "button is-info">
								<span class = "icon">
									<i class="fab fa-twitter-square"></i>
								</span>
							</a>
						</div>
					</div>

					<!-- modal for changing about image avatar -->
					<div class="modal" id = "aboutModal">
				  		<div class="modal-background" onclick = "closeModal()"></div>
				  		<div class="modal-content center has-background-grey-lighter">
				   		 <!-- Any other Bulma elements you want -->


				   		 	<!-- edit title -->
					   		 <form class = "container image_form center" id = "form" action = "php/imageUpload.php" enctype = "multipart/form-data" method = "POST" name = "submitForm">
					   		 	<div class = "field center" id = "edit_title">
					   		 		<label class = "label">Edit title</label>
					   				<input type="text" name="title_input" class = "input is-primary" id = "title_input">
					   		 	</div>

					   		 	<!-- description -->
					   		 	<div class = "field" id = "edit_desc">
				   					<div class = "control center">
				   						<label class = "label">Edit Description</label>
				   						<textarea class = "textarea has-fixed-size is-primary" id = "description_input"></textarea>
				   					</div>
					   			</div>

					   			<!-- image upload -->
					   			<section class = "section flex_row file_upload" id = "about_image_section">
					   		 	
						   		 	<!-- file input -->
					   				<div class = "file has-name is-info">
					   					<label class = "file-label center">
					   						<input type="file" name="image_upload" class = "file-input" id = "file_input" accept = "image/*, .jfif" onchange = "changePreviewImage()">
					   						<span class = "file-cta">
					   							<span class = "file-icon">
					   								<i class = "fas fa-upload"></i>
					   							</span>
					   							<span class = file-label>
					   								Choose an image to upload...
					   							</span>
					   						</span>
					   						<span class = "file-name has-background-white" id = "file_name">
					   							Image name.
					   						</span>
					   					</label>
					   				</div>

					   				<!-- preview image -->
					   				<div class = "container center preview_image" id = "about_img">
						   				<label class = "label preview_label">Preview Image</label>
						   				<figure class = "image is-128x128">
						   					<img class = "is-rounded" id = "avatar_img" src = "">
						   				</figure>
						   			</div>

					   			</section>
					   		 	<!-- submit -->
					   		 	<div class = "container update_button">
					   		 		<!-- <button class = "button is-primary" name = "update">Update About</button> -->
					   		 		<input type="button" name="submitForm" class = "button is-primary" value = "Update" id = "submit_button">
					   		 	</div>
					   		 </form>

				   		 	
				  		</div>
  						<button class="modal-close is-large is-danger" aria-label="close" onclick = "closeModal()"></button>
					</div>

				<!-- </section> -->
			</div>
		</div>
	</section>

	<!-- footer -->
	<footer class="footer has-background-primary">
	  <div class="content has-text-centered">
	      <strong>Blog</strong> by JDM made for <a href="#">John Doe</a>. 
	      <div class = "container" id = "social_media_bar">
				<a class = "button is-link">
					<span class = "icon">
						<i class="fab fa-facebook"></i>
					</span>
				</a>
				<a class = "button is-danger">
					<span class = "icon">
						<i class="fab fa-instagram"></i>
					</span>
				</a>
				<a class = "button is-info">
					<span class = "icon">
						<i class="fab fa-twitter-square"></i>
					</span>
				</a>
			</div>
	  </div>
	</footer>


	<!-- scripts -->
	<script type="text/javascript" src = "js/index_js_stuff.js"></script>
	<script src = "js/logout.js"></script>
	<script src = "js/index_events.js"></script>


</body>
</html>


<?php

	// close handles
	$handle -> close();

?>
