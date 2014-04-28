/*
 * main application javascript 
 * setting javascript version change the mainmenu class for a button after click
 * registering the notification
 * define some vars to lock the interface or to offer some default application functions
 * 
 * Andreas Ressmann
 * 23.01.2014 
 */

var version_app = '1.0.0';
var debug_page = false;
var debug_console = false;
var debug_full_information = false;
EJS.config({cache: true});
$.pnotify.defaults.history = false;

$(document).ready(function() 
{
	$('#mainmenu a').on('click', function(){
		$('#mainmenu a').addClass('btn-inverse');
		$(this).removeClass('btn-inverse');
	});
});

var Interface = {
		
		lock : function() {
			App.debug('INTERFACE LOCKED');
			$('#interface-lock').addClass('locked');
			$('#interface-lock').html('');
			$('#interface-lock-status').show();
		},
		
		unlock : function() {
			ANX.debug('INTERFACE UNLOCKED');
			$('#interface-lock').removeClass('locked');
			$('#interface-lock').html('');
			$('#interface-lock-status').hide();
		}
}

var App = {
		
	debug : function(data) {
		
		if(typeof data === 'object') {
			data = JSON.stringify(data, null, '\t');
		} 

		App.debugPrint(data);
	},
	
	debugPrint : function(stringData) {
	
		var currentdate = new Date(); 
		var h = (currentdate.getHours() < 9) ? '0'+currentdate.getHours() : currentdate.getHours();
		var m = (currentdate.getMinutes() < 9) ? '0'+currentdate.getMinutes() : currentdate.getMinutes();
		var s = (currentdate.getSeconds() < 9) ? '0'+currentdate.getSeconds() : currentdate.getSeconds();
		
		var ms = currentdate.getMilliseconds();
		if(currentdate.getMilliseconds() < 9) {
			ms = '00' + currentdate.getMilliseconds();
		} else if (currentdate.getMilliseconds() < 99) {
			ms = '0' + currentdate.getMilliseconds(); 
		}
		
		var datetime = + h + ":" + m + ":" + s + ":" + ms;
		
		if(!debug_full_information) {
			var suffix = (stringData.length > 120) ? '...' : '';
			stringData = stringData.substring(0, 120) + suffix;
		}
		
		if(debug_page)
			$('#debug').prepend('<pre id="debug">'+datetime + '<br/>' + stringData+'</pre>');
		if(debug_console)
			console.log(datetime + ': ' + stringData);
		
	},
	
	escapeHtml : function(text) {
		return text
	      .replace(/&/g, "&amp;")
	      .replace(/</g, "&lt;")
	      .replace(/>/g, "&gt;")
	      .replace(/"/g, "&quot;")
	      .replace(/'/g, "&#039;");
	},
	
	dateCurrent : function() {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		
		if(dd<10){dd='0'+dd}
		if(mm<10){mm='0'+mm} 
		return yyyy + '-' + mm + '-' + dd;
	},
	
	notify : function(title, text, type) {
		$.pnotify({ title: title, text: text, type: type, animation: 'show', delay: 2500, insert_brs: true });
	},
	
	toJSON : function(data) {
		return JSON.stringify(data);
	},
	
	fromJSON : function(data) {
		return JSON.parse(data);
	},
}
