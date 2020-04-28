function getUserInfo()
{
	let xmlhttp = get_ajaxHandle();

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