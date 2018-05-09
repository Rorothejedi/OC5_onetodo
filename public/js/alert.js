$('.alert').delay(7000).fadeOut();

function commentDelay()
{
	if ($('.show-comment').hasClass("own-comment"))
	{
		$('.show-comment').css('background-color', '#C3E6CB');
	} 
	else
	{
		$('.show-comment').css('background-color', 'rgb(230,230,230)');
	}
}
setTimeout(commentDelay, 1000);