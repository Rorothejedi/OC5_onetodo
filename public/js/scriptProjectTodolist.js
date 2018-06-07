// Dévoile le bloc permettant la création d'une Todolist
$('.button_create_todolist').click(function() 
{
	$('.createNewTodolist').slideToggle();

	if ($('.tileName').text() == 'Nouvelle todolist') 
	{
		$(".tileName").fadeOut(function() {
			$(this).text("Todolist")
		}).fadeIn();
		$('.tileNameBis').slideToggle();
	}
	else
	{
		$('.tileNameBis').slideToggle();
		$(".tileName").fadeOut(function() {
			$(this).text("Nouvelle todolist")
		}).fadeIn();
	}
});

// Gère le drag & drop des todolists
$(function()
{
    $(".todolistCollapse").sortable({
		axis : 'y',
		containment : "parent",
		revert: true,
		scrollSensitivity: 5,
		scrollSpeed: 10,

		update : function(event, ui) {

			var changedList = this.id;
			var order       = $(this).sortable('toArray');
			var positions   = order.join(';');
			var id = $(this).attr("id").split('-');

			$('#serializedOrder-' + id[1]).val(positions);
			$('#formOrder-' + id[1]).submit();
		}
    });
    
	$(".todolistCollapse").disableSelection();
});

// Script permettant de dévoiler le bloc contenant le formulaire d'ajhout d'une tâche.
$(function()
{
	$('.button_add_task').click(function(e)
	{
		e.preventDefault();
		var id = $(this).attr("id").split('-');
		$('#block_add_task-' + id[1]).slideToggle();
	});

	$('.button_cancel_add_task').click(function(e)
	{
		e.preventDefault();
		var id = $(this).attr("id").split('-');
		$('#block_add_task-' + id[1]).slideToggle();
	});
});