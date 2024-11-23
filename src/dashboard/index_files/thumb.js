function r(im) {
	if (im.src.indexOf("cdn.") == -1) im.src = "http://cdn.sploder.com/users/" + im.src.split("/users/")[1];
	else im.src = "/chrome/no.gif";
}
