

let lgoutBtn = document.getElementById("lgout");


function logout()
{
	// get ajax handle
	let xmlHttp = get_ajaxHandle();

	xmlHttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			let response = this.responseText.trim();
			console.log(response);
			if(response == "logged out")
			{
				console.log("logging out");
				location.reload();
			}
			else
			{
				// console.log(this.responseText);
				console.log("failed");
			}

		}
		else
		{
			console.log("didn't get it..");
		}

	}

	xmlHttp.open("GET", "php/logout.php", true);
	xmlHttp.send();
}


console.log(lgoutBtn);
lgoutBtn.addEventListener("click", () =>
	{
		console.log("clicked");
		logout();
	});





