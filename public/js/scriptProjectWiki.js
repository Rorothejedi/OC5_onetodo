// Script permettant de passer du bloc de lecture au bloc d'édition du wiki.
$('.button-edit-wiki').click(function() 
{
	$('#read-wiki-block').hide();
	$('#edit-wiki-block').fadeIn('slow');
	$(this).hide();
});
$('.button-cancel-edit-wiki').click(function()
{
	$('#edit-wiki-block').hide();
	$('#read-wiki-block').fadeIn('slow');
	$('.button-edit-wiki').fadeIn('slow');
});