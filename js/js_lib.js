
// for manually submitting a from button
// necessary if you need to delay submission for some time
	// ex, if you need a functions to run prior to submission
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





// ajax
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