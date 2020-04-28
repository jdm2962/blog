
let aboutTitle = document.getElementById("title");
let aboutDescription = document.getElementById("description");
let editTitle = document.getElementById("title_input");
let editDescription = document.getElementById("description_input");
let aboutImage = document.querySelector(".about_self .image .avatar_img");
let previewImage = document.querySelector("#avatar_img");


let hero = document.getElementById("hero");
let hero_title = document.getElementById("hero_title");
let hero_subtitle = document.getElementById("hero_subtitle");
let h_modal = document.getElementById("hero_modal");
let h_color = document.getElementById("hero_color");


let submit_button = document.getElementById("submit_button");
let form  = document.getElementById("form");
let hero_form = document.getElementById("hero_modal");
let hero_submit = document.getElementById("submit_hero_form");

let h_blog_title_in = document.getElementById("h_blog_title_in");
let h_subtitle_in = document.getElementById("h_blog_subtitle_in");

let color1 = document.getElementById("hero_color1");
let color2 = document.getElementById("hero_color2");
let title_color = document.getElementById("title_color_in");
let subtitle_color = document.getElementById("subtitle_color_in");

let colorChange1 = false;
let colorChange2 = false;
let title_change = false;
let subtitle_change = false;

let color_preview = document.getElementById("color_preview");
let title_preview = document.getElementById("title_preview");
let subtitle_preview = document.getElementById("subtitle_preview");

let radio_color = document.getElementsByName("answer");


// edit about modal
function openModal()
{
	let element = document.querySelector("#aboutModal");

	// make modal active
	element.classList.add("is-active");

	// load previous title and description into modal fields
	editTitle.value = aboutTitle.textContent.trim();
	editDescription.value = aboutDescription.textContent.trim();

	// load image into preview window
	previewImage.src = aboutImage.src;

}

function closeModal()
{
	let element = document.querySelector("#aboutModal");
	element.classList.remove("is-active");
}

// hero modal
function openHeroModal()
{
	// toggle visibility on
	h_modal.classList.add("is-active");

	// add values from the page to the modal
	h_blog_title_in.value = hero_title.textContent.trim();
	h_subtitle_in.value = hero_subtitle.textContent.trim();


}

function closeHeroModal()
{
	h_modal.classList.remove("is-active");
}



function updateHero()
{

	let c1;
	let c2;

	let updateList = {};
	let json_updateList = {};

	// verify if the user has entered a new value to be submitted
		// if so add to list to be sent to server
	if(h_blog_title_in.value.trim() !== hero_title.textContent.trim() && h_blog_title_in.value !== "")
	{
		updateList["title"] = h_blog_title_in.value;
	}
	if(h_subtitle_in.value.trim() !== hero_subtitle.textContent.trim() && h_subtitle_in.value !== "")
	{
		updateList["subtitle"] = h_subtitle_in.value;
	}

	// add colors to updateList if changed
		// slice the '#' from the stirng

	if(colorChange1)
	{
		c1 = color1.value.slice(1);
		updateList["color"] = c1;
	}

	if(colorChange2 && radio_color[1].checked !== true)
	{
		c2 = color2.value.slice(1);
		updateList["color2"] = c2;
	}
	if(radio_color[1].checked === true)
	{
		updateList["color2"] = "";
	}
	
	
	// add text colors
	if(title_change)
	{
		updateList["title_color"] = title_color.value.slice(1);
	}
	if(subtitle_change)
	{
		updateList["subtitle_color"] = subtitle_color.value.slice(1);
	}

	//ajax
	let xmlHttp = get_ajaxHandle();
	xmlHttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			console.log("fired");
			// console.log(JSON.parse(this.responseText));
		}
		else
		{
			console.log("didn't fire");
		}
	}

	json_updateList = JSON.stringify(updateList);
	console.log(json_updateList);
	xmlHttp.open("GET", "php/updateHero.php?json=" + json_updateList, true);
	xmlHttp.send();

}



function updateAbout()
{

	// list to hold items for update to be sent to the server
	let updateList = {};
	let returnList = {};

	// determine what needs to be sent to the server for updates
	if(editTitle.value.trim() !== aboutTitle.textContent.trim())
	{
		updateList["title"] = editTitle.value.trim();
	}
	if(editDescription.value.trim() !== aboutDescription.textContent.trim())
	{
		updateList["description"] = editDescription.value.trim();
	}


	// ajax - db update table
	let xmlhttp = get_ajaxHandle();

	if (updateList["title"] || updateList["description"])
	{
		xmlhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				// get response
				returnList = JSON.parse(this.responseText);

				// update the page
				aboutTitle.textContent = returnList["title"];
				aboutDescription.textContent = returnList["description"];
			}
		};

		json_updateList = JSON.stringify(updateList);
		// console.log(json_updateList);
		xmlhttp.open("GET", "php/updateDB.php?json=" + json_updateList, true);
		xmlhttp.send();
	}
	else
	{
		console.log("Nothing in the list!");
	}

	closeModal();
}

// load variable data from db into editable fields
function loadData()
{
	//elements
	let aboutTitle = document.getElementById("title");
	let aboutDescription = document.getElementById("description");
	// let aboutImage = document.getElementById("about_image_container");

	// load hero sections
	let hero = document.getElementById("hero");
	let hero_title = document.getElementById("hero_title");
	let hero_subtitle = document.getElementById("hero_subtitle");
	let color1 = document.getElementById("hero_color1");
	let color2 = document.getElementById("hero_color2");

	let response;

	//ajax
	let xmlhttp = get_ajaxHandle();

	xmlhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			// response data
			console.log("loaded")
			response = JSON.parse(this.responseText);
			console.log(response);
			aboutTitle.textContent = response["title"];
			aboutDescription.textContent = response["description"];
			hero_title.textContent = response["h_title"];
			hero_subtitle.textContent = response["h_subtitle"];
			color1.value = "#" + response["color"];
			color2.value = "#" + response["color2"];

			// set title preview colors
			title_preview.style.color = "#" + response["titleColor"];
			subtitle_preview.style.color = "#" + response["subtitleColor"];

			// set color input values for the title and subtitle
			title_color.value = "#" + response["titleColor"];
			subtitle_color.value = "#" + response["subtitleColor"];

			// check return colors
			if(response["color2"] == "")
			{
				radio_color[1].checked = true;
				color2.style.display = "none";

				// if no color 2, then only 1 color is selected.. fill bg with the one color
				color_preview.style.backgroundColor = "#" + response["color"];
				// fill hero background with color
				hero.style.backgroundColor = "#" + response["color"];

			}
			if(response["color2"] !== "")
			{
				radio_color[0].checked = true;
				color2.style.display = "block";

				// if yes then fill the background with a gradient between the two colors
				color_preview.style.background = "linear-gradient(45deg," + "#" + response["color"] + "," + "#" + response["color2"] + ")";
				// fill hero bg
				hero.style.background = "linear-gradient(45deg," + "#" + response["color"] + "," + "#" + response["color2"] + ")";
			}

			// load title and subtitle colors
			title_color.value = "#" + response["title_color"];
			subtitle_color.value = "#" + response["subtitle_color"];

			title_preview.style.color = "#" + response["title_color"];
			subtitle_preview.style.color = "#" + response["subtitle_color"];

			// set hero title and subtitle color
			hero_title.style.color = "#" + response["title_color"];
			hero_subtitle.style.color = "#" + response["subtitle_color"];

		}
	}
	console.log("loaded")

	xmlhttp.open("GET", "php/loadData.php", true);
	xmlhttp.send();


}


function changePreviewImage()
{
	//load file name into image name field
	let fileInput = document.querySelector("#file_input");
	let previewImage = document.querySelector("#avatar_img");

	if(fileInput.files.length > 0)
	{
		let fileName = document.querySelector("#file_name");
		fileName.textContent = fileInput.files[0].name;

	}

}


