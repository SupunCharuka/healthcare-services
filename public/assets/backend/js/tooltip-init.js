
"use strict";
$(document).ready(function() {
	var tooltip_init = {
		init: function() { 
			$("body").tooltip({
				selector: 'a,button,input'
			}); 
		}
	};
    tooltip_init.init()
});


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})