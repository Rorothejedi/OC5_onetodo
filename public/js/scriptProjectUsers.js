// Script permettant l'accès aux inputs de modification des status (page utilisateur).
$('.button-edit-user-status').click(function()
{
	$(this).hide();
	$('.text-edit-user-status').fadeIn('slow');
	$('.btn-remove-user, .select-change-access').removeAttr('disabled');
});


//Script permettant de déployer le jumbotron contenant l'ajout d'un utilisateur au projet (page utilisateur).
$('.button-add-user').click(function()
{
	$(this).hide();
	$('.title-add-user').fadeIn('slow');
	$('.block-add-user').slideToggle();
});
