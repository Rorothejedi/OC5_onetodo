// Script permettant l'ouverture et la fermuture de la div contenant le select pour les accès aux projets ouverts.
$('#statusProject').change(function() 
{
	var value = $("#statusProject option:selected").val();
	if (value == 1) 
	{
		$('.block-open-project').slideDown();
		$('#openProject').attr('required', 'required');
	}
	else
	{
		$('.block-open-project').slideUp();
		$('#openProject').removeAttr('required');
	}
});

// Script permettant l'ouverture des blocs de description des projets ouverts ainsi que le bon fonctionnement des hovers
$('.button-open-table-row').click(function() 
{
	var id = $(this).attr("id").split('-');

	$('#row_table-' + id[1]).slideToggle();
	$('#block_table-' + id[1]).slideToggle();
	$('#row_table-' + id[1] + '-bis').slideToggle();
	$('#block_table-' + id[1] + '-bis').slideToggle();

	$('.row-table-more').not('#row_table-' + id[1]).not('#row_table-' + id[1] + '-bis').slideUp();
	$('.block-table-more').not('#block_table-' + id[1]).not('#block_table-' + id[1] + '-bis').slideUp();
});

$('.secondRow').hover(function() {
	$(this).css('background-color', '#D8DADD');
	$(this).prev().css('background-color', '#D8DADD');
	}, function(){
	$(this).prev().css('background-color', 'inherit');
	$(this).css('background-color', 'inherit');
});

$('.firstRow').hover(function() {
	$(this).css('background-color', '#D8DADD');
	$(this).next().css('background-color', '#D8DADD');
	}, function(){
	$(this).next().css('background-color', 'inherit');
	$(this).css('background-color', 'inherit');
});