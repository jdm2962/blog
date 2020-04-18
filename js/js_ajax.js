function getUserInfo()
{
	let xmlhttp;

	// console.log("getUserInfo called");
	if (window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Miscrosoft.XMLHTTP");
		console.log("active");
	}

	// console.log("xml");
	// let user_logged_in = false;
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{

			if (this.responseText == "User is logged in")
			{
				console.log("logged in");
				var onList = document.getElementsByClassName("display_if_logged_in");
				for(let i = 0; i < onList.length; i++)
				{
					onList[i].style.display = "block"
				}
			}
			else
			{
				console.log("Not logged in");
				var offList = document.getElementsByClassName("display_if_logged_in");
				for(let i = 0; i < offList.length; i++)
				{
					offList[i].style.display = "none"
				}
				
			}
		}
		else
		{
			// console.log("didn't run");
		}
	}

	xmlhttp.open("GET", "php/response.php", true);
	xmlhttp.send();


}