window.onload = function()
{

	getUserInfo();
	loadData();
}

// check for input from radio color 
// for toggling gradient color on/off
for(let i = 0; i < radio_color.length; i++)
{
	radio_color[i].addEventListener("click", () =>
		{
			if(radio_color[0].checked == true)
			{
				console.log("r1 checked");
				color2.style.display = "block"
				// on switch to 'yes' for optional color set to gradient
				color_preview.style.background = "linear-gradient(45deg," + color1.value + "," + color2.value + ")";
			}
			if(radio_color[1].checked == true)
			{
				console.log("r2 checked");
				color2.style.display = "none"
				// set preview bg color to the single color
				color_preview.style.background = color1.value;
			}
		});
}


// hero background colors(color1, color2)
color1.addEventListener("change", () =>
{
	console.log("color 1 changed");
	colorChange1 = true;
	// change preview color
	if(radio_color[0].checked === true)
	{
		color_preview.style.background = "linear-gradient(45deg," + color1.value + "," + color2.value + ")";
	}
	else
	{
		color_preview.style.background = color1.value;

	}
	
});

color2.addEventListener("change", () =>
{
	console.log("color 2 changed");
	colorChange2 = true;
	// change preview bg to linear gradient between the two colors
	color_preview.style.background = "linear-gradient(45deg," + color1.value + "," + color2.value + ")";
});

title_color.addEventListener("change", () =>
{
	title_preview.style.color = title_color.value;
	title_change = true;
})

subtitle_color.addEventListener("change", () =>
{
	subtitle_preview.style.color = subtitle_color.value;
	subtitle_change = true;
})

// about form
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


// hero form
hero_form.addEventListener("submit", (event) =>
{
	event.preventDefault();
});

hero_submit.addEventListener("click", () =>
{
	updateHero();
	setTimeout(() =>
		{
			location.reload();
		}, 500);
});