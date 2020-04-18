// functions to run on page load

let submit_button = document.getElementById("submit_button");
let form  = document.getElementById("form");


window.onload = function()
{
	getUserInfo();
	loadData();
}




form.addEventListener("submit", function(event)
	{
		event.preventDefault();
	});

submit_button.addEventListener("click", () => 
	{

		updateAbout();
		setTimeout(() =>
			{
				console.log("clicked");
				manualSubmission(form, "submitForm", "hidden button");
			}, 500);
	});


function manualSubmission(frm, name, value)
{
	console.log("called");
	//manually submit using a button instead of submit button
	// create an element to append to the
	let hiddenInput = document.createElement("input");

	// append attributes:
		// hide element, set name, set value
	hiddenInput.setAttribute("type", "hidden");
	hiddenInput.setAttribute("name", name);
	hiddenInput.setAttribute("value", value);
	// append
	form.appendChild(hiddenInput);

	// submit
	frm.submit();
}



function openModal()
{
	let element = document.querySelector("#aboutModal");
	let aboutTitle = document.getElementById("title");
	let aboutDescription = document.getElementById("description");
	let editTitle = document.getElementById("title_input");
	let editDescription = document.getElementById("description_input");
	let aboutImage = document.querySelector(".about_self .image .avatar_img");
	let previewImage = document.querySelector("#avatar_img");

	
	// TODO : load file from input into preview display window(temporarily for preview)


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

function openPostModal()
{
	let element = document.getElementById("postModal");
	element.classList.add("is-active");
}

function closePostModal()
{
	let element = document.getElementById("postModal");
	element.classList.remove("is-active");
}


function updateAbout()
{
	console.log("update btn ran");

	let aboutTitle = document.getElementById("title");
	let aboutDescription = document.getElementById("description");
	let editTitle = document.getElementById("title_input");
	let editDescription = document.getElementById("description_input");
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
	// location.reload();
}

// load variable data from db into editable fields
function loadData()
{
	// console.log("loaded")
	//elements
	let aboutTitle = document.getElementById("title");
	let aboutDescription = document.getElementById("description");
	// let aboutImage = document.getElementById("about_image_container");

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
			// console.log(response)
			aboutTitle.textContent = response["title"];
			aboutDescription.textContent = response["description"];

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

		// load image into preview window
		console.log(previewImage);
		previewImage.src = "css/images/" + fileInput.files[0].name;
	}

}

function get_ajaxHandle()
{
	let xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	return xmlhttp;
}