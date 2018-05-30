// Script pour pouvoir envoyer un message avec les touches entrées
$('#userMessage').keydown(function(event) 
{
	var attr = $('#userMessage').attr('readonly');

	if (attr === undefined) {
	    if (event.keyCode == 13) 
	    {
	        if (!event.shiftKey) 
	        {
	        	$('#formUserMessage').submit();
	        }
	    }
	}
});