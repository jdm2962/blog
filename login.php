
<?php
	// start session
	session_start();

?>

<!DOCTYPE html>

<?php
	// includes
	include "../../inc/dbinfo.inc";
	include "../../inc/data.inc";

?>

<!-- CREATE DATABASE AND TABLE IF IT DOESN'T EXIST -->
<?php
	//connect
	
	$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
	if ($handle -> connect_error)
	{
		echo "Error: " . $handle -> connect_error;
	}
	else
	{
		// echo "Connected.";
	}

	// create database
	$sql = "CREATE DATABASE IF NOT EXISTS real_blogDB";
	if ($handle -> query($sql))
	{
		// echo "Created db";
	}
	else
	{
		echo "Error: " . $handle -> error;
	}

	$handle -> close();



	
	// create table
	$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, "real_blogDB");


	$sql = "CREATE TABLE IF NOT EXISTS loginTable (
			id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			username VARCHAR(30),
			password VARCHAR(255) 
		)";
	if($handle -> query($sql))
	{
		// echo "Table created.";
	}
	else
	{
		echo "Error, could not create table: " . $handle -> error;
	}

	
	// create user. done manually this time, since there is only 1 person that need to login: the blog owner

	$user = USER;

	// check whether the user exists
	$sql = "SELECT username FROM loginTable WHERE username = '$user'";
	$result = $handle -> query($sql);
	if ($result -> num_rows > 0)
	{
		// echo "There is something in this table";
	}
	else
	{
		$password = PASSWORD;
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		// echo strlen($hashed_password);
		$sql = "INSERT INTO loginTable (username, password) 
				VALUES ('$user', '$hashed_password')";
		if($handle -> query($sql))
		{
			echo "User entered";
		}
		else
		{
			echo "User data not entered";
		}
		
	}

	$result -> close();
	$handle -> close();
?>


<!DOCTYPE html>
<html>
	
	<head>
		<title>Login</title>
		<meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scal = 1">

		<!-- bulma -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<!-- custom styles -->
		<link rel="stylesheet" type="text/css" href="css/custom_styles.css">
		<!-- font awsome -->
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	</head>

	<body class = "has-background-grey">

		<section class = "section main_section has-background-white-ter">
			<form class = "container center login_form" aciton = "login.php" method = "POST">
				<!-- title -->
				<h1 class = "title is-1 header1">Login</h1>

				<!-- username -->
				<div class = "field">
					<label class = "label">Username</label>
					<div class = "control has-icons-left">
						<input type="text" name="username" class = "input text_input has-background-grey-lighter text_input_1 is-primary is-medium" placeholder = "Username">
						<span class = "icon is-small is-left">
							<i class="fas fa-user has-text-grey is-light"></i>
						</span>
					</div>
				</div>

				<!-- password -->
				<div class = "field">
					<label class = "label">Password</label>
					<div class = "control has-icons-left">
						<input type="password" name="password" class = "input text_input has-background-grey-lighter is-primary is-medium" placeholder = "Password">
						<span class = "icon is-small is-left">
							<i class = "fas fa-lock has-text-grey"></i>
						</span>
					</div>
				</div>

				<!-- submit -->
				<div class = "field submit_field">
					<div class = "control">
						<input type="submit" name="submit" class = "button submit_input is-primary is-outlined is-rounded is-large" value = "Login">
					</div>
				</div>
				
				</form>
			</section>
	


		<?php
	
			$username = $_POST['username'];
			$password = $_POST['password'];
			$url = '../blog';

			// validate that the username and password are only strings(in this case)

			// check if username and password match
			// connect to db
			$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, "real_blogDB");

			if ($handle -> connect_error)
			{
				die("Error connecting: " . $handle -> connect_error);
			}
			else
			{
				if ($username & $password)
				{
					// echo "Connected!";
					// verify login details
					$stmt = $handle -> prepare("SELECT username, password FROM loginTable WHERE username = ?");
					$stmt -> bind_param('s', $username);
					// echo "running";

					
					if ($stmt -> execute())
					{
						echo "executed";
						$result = $stmt -> get_result();
						echo $result -> num_rows;
						while($row = $result -> fetch_row())
						{
							if (password_verify($password, $row[1]))
							{
								$_SESSION['user_logged_in'] = true;
								header("location:$url");
							}
							else
							{
								echo "Incorrect password! <br>";
							}
							
						}
						
					}
					else
					{
						echo "Username not valid.";
					}
					$stmt -> close();
					$result -> close();
				}
				else
				{
					echo "Fill out both fields";
				}
				
			}
			$handle -> close();

			// if correct login direct user to blog posts page
			
		?>

	</body>


</html>