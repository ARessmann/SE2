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
 * Password check for setting a new password
 */
function initTriggers() {
	App.debug('initTriggers()');
	
	$('#password-submit').on('click', function(e) {
		var pwA = $('#password').val();
		var pwB = $('#password_confirm').val();
		
		if (pwA != pwB || pwA.length < 3) {
			App.notify('Passwort', 'Passwörter stimmen nicht überein oder haben nicht mindestens 3 Zeichen!', 'error');
		}
		else {
			App.notify('Passwort', 'Passwort erfolgreich geändert', 'success');
			_submitForm (800);
		}
	});
	
	$('.icon-edit').on('click', function(e) {
		editModal($(this).attr('data-id'), $(this).attr('view-name'));
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
		case 'accountmanager':
			deleteAccountManager (data_id);
			break;
		case 'device':
			deleteDevice (data_id);
			break;
		case 'customer':
			deleteCustomer (data_id);
			break;
	}
}

/*
 * choose the right way to edit the object by the given viewName
 */
function editModal(data_id, viewName) {
	//App.debug('editModal(' + data_id +', ' + viewName +')');
	
	var modal 		= null;
	
	switch (viewName) {
		case 'accountmanager':
			editAccountManager (data_id, viewName);
			break;
		case 'device':
			editDevice (data_id, viewName);
			break;
		case 'customer':
			editCustomer (data_id, viewName);
			break;
		case 'newbooking':
			newBooking (data_id, viewName);
			break;
	}
}

/*
 * submitting the form by the given viewName
 */
function submitModal(viewName) {
	//App.debug('editModal(' + data_id +', ' + viewName +')');
	
	var modal 		= null;
	
	switch (viewName) {
		case 'accountmanager':
			editAccountManagerSubmit ();
			break;
		case 'device':
			editDeviceSubmit ();
			break;
		case 'customer':
			editCustomerSubmit ();
			break;
		case 'newbooking':
			newBookingSubmit ();
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

//AcountManager
/*
 * main function to show a new AccountManager or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editAccountManager (data_id, viewName) {
	
	if (data_id == null) {
		var data = {
			id: '',
			identity: '',
			persnr: '',
			firstname: '',
			lastname: '',
			telnr: '',
			address: ''
		};
		
		modal = new EJS({url: '/assets/tpl/modal_accountmanager_edit.ejs?v='+version_app}).render(data);
		_addModalHandle (modal, viewName);
	}
	else {
		$.ajax({
			dataType : 'json',
			error : function() {
				App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
			},
			success : function(data) {
	
				modal = new EJS({url: '/assets/tpl/modal_accountmanager_edit.ejs?v='+version_app}).render(data);
				_addModalHandle (modal, viewName);
			},
			type : 'GET',
			url : '/api/getaccountmanager/id/' + data_id
		});
	}
}

/*
 * main function to persist the viewed AccountManager in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editAccountManagerSubmit () {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		identity: $('#auth_identity').val(),
		persnr: $('#pers_nr').val(),
		firstname: $('#auth_user_firstname').val(),
		lastname: $('#auth_user_lastname').val(),
		telnr: $('#auth_user_telnr').val(),
		address: $('#adress_field').val()
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);
	
	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim übertragen der Daten ist es zu einem Fehler gekommen', 'error');
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
		url: '/api/editaccountmanager/'
	});
}

/*
 * main funtion to delete a AccountManager 
 * the form will be submitted after displaying the response
 */
function deleteAccountManager (data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
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
		url : '/api/deleteaccountmanager/id/' + data_id
	});
}

//Device
/*
 * main function to show a new Device or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editDevice (data_id, viewName) {
	
	if (data_id == null) {
		var data = {
			id: '',
			identity: '',
			password: '',
			devicenr: '',
			description: '',
			type: ''
		};
		
		modal = new EJS({url: '/assets/tpl/modal_device_edit.ejs?v='+version_app}).render(data);
		_addModalHandle (modal, viewName);
	}
	else {
		$.ajax({
			dataType : 'json',
			error : function() {
				App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
			},
			success : function(data) {
	
				modal = new EJS({url: '/assets/tpl/modal_device_edit.ejs?v='+version_app}).render(data);
				_addModalHandle (modal, viewName);
			},
			type : 'GET',
			url : '/api/getdevice/id/' + data_id
		});
	}
}

/*
 * main function to persist the viewed Device in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editDeviceSubmit () {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		identity: $('#auth_identity').val(),
		password: $('#auth_password').val(),
		devicenr: $('#device_nr').val(),
		description: $('#description').val(),
		type: $('#type').val()
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);
	
	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim übertragen der Daten ist es zu einem Fehler gekommen', 'error');
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
		url: '/api/editdevice/'
	});
}

/*
 * main funtion to delete a Device
 * the form will be submitted after displaying the response
 */
function deleteDevice (data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
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
		url : '/api/deletedevice/id/' + data_id
	});
}

//Customer
/*
 * main function to show a new Customer or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function editCustomer (data_id, viewName) {
	
	if (data_id == null) {
		var data = {
			id: '',
			identity: '',
			firstname: '',
			lastname: '',
			telnr: '',
			address: ''
		};
		
		modal = new EJS({url: '/assets/tpl/modal_customer_edit.ejs?v='+version_app}).render(data);
		_addModalHandle (modal, viewName);
	}
	else {
		$.ajax({
			dataType : 'json',
			error : function() {
				App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
			},
			success : function(data) {
	
				modal = new EJS({url: '/assets/tpl/modal_customer_edit.ejs?v='+version_app}).render(data);
				_addModalHandle (modal, viewName);
			},
			type : 'GET',
			url : '/api/getcustomer/id/' + data_id
		});
	}
}

/*
 * main function to persist the viewed Customer in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function editCustomerSubmit () {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		identity: $('#auth_identity').val(),
		firstname: $('#auth_user_firstname').val(),
		lastname: $('#auth_user_lastname').val(),
		telnr: $('#auth_user_telnr').val(),
		address: $('#adress_field').val()
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);
	
	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim übertragen der Daten ist es zu einem Fehler gekommen', 'error');
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
		url: '/api/editcustomer/'
	});
}

/*
 * main funtion to delete a Customer
 * the form will be submitted after displaying the response
 */
function deleteCustomer (data_id) {
	$.ajax({
		dataType : 'json',
		error : function() {
			App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
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
		url : '/api/deletecustomer/id/' + data_id
	});
}

//newbooking
/*
 * main function to show a new Amount of a Customer or edit a persisted
 * the partial html will be rendered with EJS, if a persisted one was opend 
 * the data was set automatically
 */
function newBooking (data_id, viewName) {
	
	if (data_id == null) {
		var data = {
			id: '',
			amount: ''
		};
		
		modal = new EJS({url: '/assets/tpl/modal_newbooking_edit.ejs?v='+version_app}).render(data);
		_addModalHandle (modal, viewName);
	}
	else {
		$.ajax({
			dataType : 'json',
			error : function() {
				App.notify('Unbekannter Fehler', 'Beim laden der Daten ist es zu einem Fehler gekommen', 'error');
			},
			success : function(data) {
	
				modal = new EJS({url: '/assets/tpl/modal_newbooking_edit.ejs?v='+version_app}).render(data);
				_addModalHandle (modal, viewName);
			},
			type : 'GET',
			url : '/api/getcustomer/id/' + data_id
		});
	}
}

/*
 * main function to persist the viewed Amount of the Customer in the dialog
 * the form data will be posted by ajax after displaying the respone the 
 * form will be submitted
 */
function newBookingSubmit () {
	var postData = {
		id: $('#modal-submit').attr('data-id'),
		amount: $('#amount').val()
	};
	
	postData = App.toJSON(postData);
	App.debug('POST: ' + postData);
	
	$.ajax({
		data: { 'data': postData },
		dataType: 'json',
		error: function() {
			App.notify('Unbekannter Fehler', 'Beim übertragen der Daten ist es zu einem Fehler gekommen', 'error');
		},
		success: function(data) {
			
			if(data.error == true) {
				App.notify('Fehler: '+data['error_title'], data['error_description'], 'error');
			} else {
				$('#modal-info').modal('hide');
				App.notify(data['success_title'], data['success_description'], 'success');
				_submitForm ();
			}
		},
		type: 'POST',
		url: '/api/newbooking/'
	});
}
