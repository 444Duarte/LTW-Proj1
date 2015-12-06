function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
	
function goingStatus(){

	/*var url = 'php/event.php';
	var form = $('<form action="' + url + '" method="post">' +
	  '<input type="text" name="event" value="' + getUrlParameter('event') + '" />' +
	  '<input type="text" name="request" value="request" />'+ 
	  '</form>');
	$('body').append(form);
	form.submit();*/

	$.post(
            'php/event.php',
            {
                'event' : getUrlParameter('event'),
                'request' : 'request'
            },
            function(data) {
                var response = data['event'];
                switch(response) {
                    case 'going':
                        $('#option select').val("going");
                        break;
                    case 'not going':
                        $('#option select').val("not");
                        break;
                    case 'not invited':
                    	break;
                    default:
                        swal("Error!","Failure processing the attendence status", "error");
                        $('body').append(data['event']);
                        break;
                }
        }).fail(function(error) {
                $('body').append(error.responseText);
                return false;
            });
}



$(document).ready(function(){
	goingStatus();
} );
