function toggle(self, objId) {
	obj = document.getElementById(objId);
	if(obj.className.match("opened")) {
		self.title = "Click to expand";
		obj.className = obj.className.replace(/opened/,"closed");
		
	} else {
		self.title = "Click to collapse";
		obj.className = obj.className.replace(/closed/,"opened");
	}
	return false;
}
function expand(open) {
	var tbodies = document.getElementById("content").getElementsByTagName("TBODY");
	for (var i=0; i<tbodies.length; i++) {
		if(open) tbodies[i].className = tbodies[i].className.replace(/closed/,"opened");
		else tbodies[i].className = tbodies[i].className.replace(/opened/,"closed");
	}
	return false; 
}