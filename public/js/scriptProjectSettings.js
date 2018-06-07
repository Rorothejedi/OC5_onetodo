// Script permttant l'accès aux inputs de paramètres du projet.
$('.button-edit-project-disabled').click(function() 
{
	$('#descriptionProject, #colorProject, #statusProject, #nameProject, #openProject').removeAttr('disabled');
	$('.button-edit-project').show();
	$(this).hide();
});
