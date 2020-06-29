$('[data-toggle="tooltip"]').tooltip()

function notifySuccess(notificationMessage){
    $('#feedback').html(notificationMessage);
	$('#feedback').delay(98).fadeIn();
	$('#feedback').delay(1968).fadeOut();
}

function notifyFailure(notificationMessage){
    $('#feedback-failure').html(notificationMessage);
	$('#feedback-failure').delay(98).fadeIn();
	$('#feedback-failure').delay(1968).fadeOut();
}