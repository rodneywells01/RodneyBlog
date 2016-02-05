function load_content(newpage) {
	// Load content of new page and prevent default action.	
	// Returns the current page. 
	// var new_currentpage = currentpage;
	// if (newpage != currentpage) {
		// Load page and set currentpage. 
		handle_transitions(newpage + ".php", $("#mainarea"));
		new_currentpage = newpage;
	// }
	// return new_currentpage;
}

function handle_transitions(page, contentdiv) {
	exit_main_content(contentdiv); // Disappear div.  

	setTimeout(function() {
		contentdiv.load(page, function(){
			enter_main_content(contentdiv);
		});
	}, 300); 
}

function exit_main_content(contentdiv){
	//Fade div and content out.
	contentdiv.fadeOut(100);
}

function enter_main_content(contentdiv) {
	//Fade div and content in. 
	contentdiv.fadeIn(100);
}