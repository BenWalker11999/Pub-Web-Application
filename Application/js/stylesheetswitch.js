/*code taken from stackoverflow: Camilo (2016) [Computer program] Dynamically Switching CSS Files. https://stackoverflow.com/questions/41355371/dynamically-switching-css-files 
the code allows for a user to change between stylesheets with a click of a button, there are 2 buttons on the accessibility page, one for white text for the webstie, the other for yellow text, uses local storage
so that we can store the choice across pages and stores it when the page is closed so choices are saved*/
var cssStyle = document.getElementById('style');

window.onload = function(){
	if(localStorage && localStorage.getItem("style"))
		cssStyle.href = localStorage.getItem("style");
};

function setStyle(newStyle){
	cssStyle.href = newStyle;
	
	if(localStorage)
		localStorage.setItem("style", newStyle);
};