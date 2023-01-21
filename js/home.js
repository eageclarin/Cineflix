//reload page once
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}

//get title of clicked image
function setTitle(getTitle) {
    var movie = document.getElementById("title");
    movie.value = getTitle;
    return true;
}

//show scroll to top if
window.onscroll = function() {
	scroll();
}

function scroll() {
	var up = document.getElementById("up");

	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		up.style.display = "block";
	} else {
		up.style.display = "none";
	}
}

function toTop() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}

//adjusting iframe height
function adjustIframe() {
	var iframe = document.getElementById('display');
	if(iframe) {
		var height = iframe.contentWindow.document.body.scrollHeight;

		if (height > 3000) {
			iframe.style.height = height + 300 + "px";
		} else {
			iframe.style.height = height + (height / 4) + "px";
		}
	}
	parent.adjustIframe(); 
}