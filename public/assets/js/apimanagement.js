/*
 * javascript for handling modal dialogs
 * it includes the eventregistration for different icons
 * also included the ajax calls to modify editable objects
 * 
 * Andreas Ressmann
 * 24.01.2014 
 */
$(document).ready(function() {
	//Interface.lock();
	initTriggers();	
});

/*
 * Registration of some events to edit or delete objects
 */
function initTriggers() {
	App.debug('initTriggers()');
	
	$('.icon-edit').on('click', function(e) {
		editModal($(this).attr('data-id'), $(this).attr('view-name'));
	});
	
	// onclick event for the edit of a filter object (icon-briefcase)
	$('.icon-briefcase').on('click', function(e) {
		if($(this).attr('data-id') != '' && $(this).attr('data-id') != '0')
			editModal($(this).attr('data-id'), $(this).attr('view-name'));
	});	
	
	// onclick event for the delete of a filter object (icon-briefcase)
	$('.icon-delete-filter').on('click', function(e) {
		if($(this).attr('data-id') != '' && $(this).attr('data-id') != '0'){
			var info = confirm("Wollen Sie diesen Eintrag wirklich löschen?");
			if(info == true){
				deleteItem($(this).attr('data-id'), $(this).attr('view-name'));
			}
		}
	});	
	
	$('.icon-pencil').on('click', function(e) {
		editModal($(this).attr('data-id'), $(this).attr('view-name'));
	});
	
	$('.icon-ban-circle').on('click', function(e) {
		
		var info = confirm("Wollen Sie diesen Eintrag wirklich löschen?");
		if (info == true) {
			deleteItem($(this).attr('data-id'), $(this).attr('view-name'));				  
		}
		
	});
	
	$('#search_btn').on('click', function(e) {
		search($(this).attr('view-name'));
	});
	
	// function for filter-add button for correct disable/enable handling
	$(function(){
	      //Set button disabled
	      $("#filter-add").attr("disabled", "disabled");
	 
          var selectedEventId = $("select#choose_event option:selected").val();
          if(selectedEventId == 0)
        	$("#filter-add").attr("disabled", "disabled");
       	  else
       		$("#filter-add").removeAttr("disabled");  
	})
	
	// function for filter-drop-down for correct disable/enable handling
	$(function(){
	      //Set button disabled
	      $("#choose_filter").attr("disabled", "disabled");
	 
          var hasFilter = $("select#choose_filter").find("option").length;
          if(hasFilter < 2)
        	$("#choose_filter").attr("disabled", "disabled");
       	  else
       		$("#choose_filter").removeAttr("disabled");  
	})
	
	// function for start analysis button for correct disable/enable handling
	$(function(){
	      //Set button disabled
	      $("#useFilter").attr("disabled", "disabled");
	      
          var minTweets = parseInt($("#tw_min").val());
          var countTweets = parseInt($("#counter").text());
          
          if(minTweets > countTweets || isNaN(minTweets)){
        	$("#useFilter").attr("disabled", "disabled");
        	$("#useFilter").removeAttr("onclick");
          }
       	  else {
       		$("#useFilter").removeAttr("disabled");
       		$("#useFilter").attr("onclick", "javascript:saveAnalysisSubmit();");
       	  }
	})
	
}

/*
 * select/deselect all checkboxes 
 */

function select_all(){
	
	for ( var i = 0; i < $(".tweet_delete").length; i++ )
    {
    	if(!$(".tweet_delete")[i].checked)
    		var check = true;
    }
	if(check){
	    	$(".tweet_delete").prop("checked", true);	
	}
	else
	{
	    	$(".tweet_delete").prop("checked", false);
	    	check = false;
	}
}

/*
 * setting the searchvalue to a hidden field 
 * and submitting the form with no delay 
 */
function search (viewName) {
	$('#filter').val($('#search_field').val());
	_submitForm(0);
}

/*
 * choose the right way to delete the object by the given viewName
 */
function deleteItem(data_id, viewName) {
	switch (viewName) {
		case 'event':
			deleteEvent (data_id);
			break;
		case 'filter':
			deleteFilter(data_id);
			break;
		case 'sentiment':
			deleteSentiment(data_id);
			break;
	}
}

/*
 * choose the right way to edit the object by the given viewName
 */
function editModal(data_id, viewName, event_id) {
	// App.debug('editModal(' + data_id +', ' + viewName +')');
	
	var modal = null;

	switch (viewName) {
		case 'event':
			editEvent (data_id, viewName);
			break;
		case 'filter':
			if($("#filter-add").attr("disabled") != "disabled")
				editFilter(data_id, viewName, event_id);
			break;
		case 'sentiment':
			editSentiment(data_id, viewName);
			break;
	}
}

/*
 * submitting the form by the given viewName
 */
function submitModal(viewName) {
	//App.debug('editModal(' + data_id +', ' + viewName +')');
	
	var modal = null;
	
	switch (viewName) {
		case 'event':
			editEventSubmit ();
			break;
		case 'filter':
			editFilterSubmit();
			break;
		case 'sentiment':
			editSentimentSubmit ();
			break;
	}
}

/*
 * setting the rendered ejs div and register the submit click event
 */
function _addModalHandle (modal, viewName) {
	$('#modal').html(modal);
	$('#modal-info').modal();
	$('#modal-submit').on('click', function(){
		submitModal(viewName, 1000);
	});
}

/*
 * submitting the form after a given delay
 */
function _submitForm (delay) {
	setTimeout(function(){
        $('#action_frm').submit();
    }, delay);
}

/*
 * main function to show a new Event or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editEvent (data_id, viewName) {
	
	//get texts
	$.get('/api/gettranslations', { viewName: viewName },  function( translations ) {
		if (data_id == null) {
			var data = {
				translations: translations, //must have for each dlg
				
				id: '',
				event_description: '',
				event_title: '',
				event_from: '',
				event_to: '',
				event_tw_count: '',
				event_state: '',
				event_tweet_tags: ''
			};

			modal = new EJS({url: '/assets/tpl/modal_event_edit.ejs?v='+version_app}).render(data);
			_addModalHandle (modal, viewName);
		}
		else {
			$.ajax({
				dataType : 'json',
				error : function() {
					App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
				},
				success : function(data) {
					data['translations'] = translations;
					
					modal = new EJS({url: '/assets/tpl/modal_event_edit.ejs?v='+version_app}).render(data);
					_addModalHandle (modal, viewName);
				},
				type : 'GET',
				url : '/api/getevent/id/' + data_id
			});
		}
	});
}

/*
 * main function to persist the viewed Event in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editEventSubmit () {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		event_description: $('#event_description').val(),
		event_title: $('#event_title').val(),
		event_from: $('#event_from').val(),
		event_to: $('#event_to').val(),
		event_tw_count: $('#event_tw_count').val(),
		event_state: $('#event_state').val(),
		event_tweet_tags: $('#event_tweet_tags').val()
	};
	console.log($('#event_from').val());
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);

	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim Übertragen der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success: function(data) {

			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				$('#modal-info').modal('hide');
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type: 'POST',
		url: '/api/editevent/'
	});
}

/*
 * main funtion to delete an Event 
 * the form will be submitted after displaying the response
 */
function deleteEvent (data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim Laden der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success : function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type : 'GET',
		url : '/api/deleteevent/id/' + data_id
	});
}

/*
 * main function to show a new Filter or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editFilter (data_id, viewName, event_id)
{	
	//get texts
	$.get('/api/gettranslations', { viewName: viewName },  function( translations ) {
		if (data_id == null){
			var data = {
				translations: translations, //must have for each dlg
				
				id: '',
				filter_name: '',
				filter_tags: '',
				filter_from: '',
				filter_to: '',
				filter_location: '',
				filter_language: '',
				event_id: event_id
			};
			
			modal = new EJS({url: '/assets/tpl/modal_filter_edit.ejs?v='+version_app}).render(data);
			_addModalHandle (modal, viewName);
		}
		else {
			$.ajax({
				dataType : 'json',
				error : function() {
					App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
				},
				success : function(data) {
					data['translations'] = translations;

					modal = new EJS({url: '/assets/tpl/modal_filter_edit.ejs?v='+version_app}).render(data);
					_addModalHandle (modal, viewName);
				},
				type : 'GET',
				url : '/api/getfilter/id/' + data_id
			});
		}
	});
}

/*
 * main function to persist the viewed filter in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editFilterSubmit ()
{
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		filter_name: $('#filter_name').val(),
		filter_tags: $('#filter_tags').val(),
		filter_from: $('#filter_from').val(),
		filter_to: $('#filter_to').val(),
		filter_location: $('#filter_location').val(),
		filter_language: $('#filter_language').val(),
		event_id: $('#modal-submit').attr('event-id')
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);

	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim Übertragen der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success: function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				$('#modal-info').modal('hide');
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type: 'POST',
		url: '/api/editfilter/'
	});
}

/*
 * main funtion to delete an Filter 
 * the form will be submitted after displaying the response
 */
function deleteFilter (data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim Laden der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success : function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				$('#choose_filter').val('0');
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type : 'GET',
		url : '/api/deletefilter/id/' + data_id
	});
}


/*
 * function to save a new Analysis 
 */
function saveAnalysisSubmit () 
{
	var postData = {
		event_id: $('#event_id').val(),
		filter_id: $('#filter_id').val(),
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);

	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim Übertragen der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success: function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type: 'POST',
		url: '/api/saveanalysis/'
	});
}
/*
 * main function to show a new Sentiment word or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editSentiment(data_id, viewName) 
{
	var languages;
	var lang_trans;
	
	// make 3 requests afterwarth.. First get out the available languages (de,at,en,us,etc)
	// then the translations of the languages are needed. so make a translation request.
	// after this, the general modal handling is done via ajax call.
	$.get('/api/getlanguages', null,  function( data ) {
		languages = data;
		$.get('/api/gettranslations', {viewName: 'lang_'}, function (data){
			lang_trans = data;
			$.get('/api/gettranslations', { viewName: viewName },  function( translations ) {
				if (data_id == null) 
				{

					if(typeof(languages) == 'undefineed')
						setTimeout(300);
					
					var data =
					{
						translations: translations, //must have for each dlg
						lang_trans: lang_trans,
						languages: languages,
						id: '',
						sent_language: '',
						sent_word: '',
						sent_weight: ''
					};

					modal = new EJS({url: '/assets/tpl/modal_sentiment_edit.ejs?v='+version_app}).render(data);
					_addModalHandle (modal, viewName);
				}
				else {
					$.ajax({
						dataType : 'json',
						error : function() {
							App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
						},
						success : function(data) {
							data['translations'] = translations;
							data['lang_trans'] = lang_trans;
							data['languages'] = languages;
							modal = new EJS({url: '/assets/tpl/modal_sentiment_edit.ejs?v='+version_app}).render(data);
							_addModalHandle (modal, viewName);
						},
						type : 'GET',
						url : '/api/getsentiment/id/' + data_id
					});
				}
			});
		});
	});
}

/*
 * main function to persist the viewed sentiment word in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editSentimentSubmit() {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		sent_language: $('#sent_language').val(),
		sent_word: $('#sent_word').val(),
		sent_weight: $('#sent_weight').val()
	};

	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);

	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim Übertragen der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success: function(data) {

			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				$('#modal-info').modal('hide');
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type: 'POST',
		url: '/api/editsentiment/'
	});
}

/*
 * main funtion to delete an sentiment 
 * the form will be submitted after displaying the response
 */
function deleteSentiment(data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim Laden der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success : function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type : 'GET',
		url : '/api/deletesentiment/id/' + data_id
	});
}

/*
 * main funtion to delete Tweets 
 * the form will be submitted after displaying the response
 */
function deleteTweets () {
	var data_id = new Array();
	for ( var i = 0; i < $(".tweet_delete").length; i++ )
    {
    	if($(".tweet_delete")[i].checked)
    		data_id[i] = $(".tweet_delete")[i].value;
    	
    }
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim Laden der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success : function(data) {
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm (1000);
			}
		},
		type : 'GET',
		url : '/api/deletetweets/id/' + data_id
	});
}
