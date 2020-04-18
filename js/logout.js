

// get ajax handle
let xmlHttp = get_ajaxHandle();

xmlHttp.onreadystatechange = function()
{
	if(this.readystate == 4 && this.status == 200)
	{
		console.log(this.responseText);

	}

	xmlHttp.open("GET", "php/logout.php", true);
	xmlHttp.send();
}
