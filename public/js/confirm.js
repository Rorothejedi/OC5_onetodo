$(function() 
{
	$('button[data-confirm]').click(function() 
	{
		if (!$('#dataConfirmModal').length) 
		{
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' + 
				'<div class="modal-dialog">' + 
					'<div class="modal-content">' +
					 	'<div class="modal-header">' + 
					 		'<h5 id="dataConfirmLabel">Merci de confirmer</h5>' + 
					 		'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">' + 
					 			' <span aria-hidden="true">&times;</span>' + 
					 		'</button>' +
					 	'</div>' + 
					 	'<div class="modal-body"></div>' + 
					 	'<div class="modal-footer">' + 
					 		'<button type="button" class="btn btn-primary" id="dataConfirmOK" data-dismiss="modal" aria-hidden="true">Confirmer</button>' + 
					 		'<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> ' + 
					 	'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));

		$('#dataConfirmOK').click(function()
		{
			$('form').submit();
		});

		$('#dataConfirmModal').modal('show');
		return false;
	});
});

$(function() 
{
	$('a[data-confirm]').click(function(e) 
	{
		var href = $(this).attr('href');
		
		if (!$('#dataConfirmModal').length) 
		{
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' + 
				'<div class="modal-dialog">' + 
					'<div class="modal-content">' +
					 	'<div class="modal-header">' + 
					 		'<h5 id="dataConfirmLabel">Merci de confirmer</h5>' + 
					 		'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">' + 
					 			' <span aria-hidden="true">&times;</span>' + 
					 		'</button>' +
					 	'</div>' + 
					 	'<div class="modal-body"></div>' + 
					 	'<div class="modal-footer">' + 
					 		'<button type="button" class="btn btn-primary" id="dataConfirmOK" data-dismiss="modal" aria-hidden="true">Confirmer</button>' + 
					 		'<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> ' + 
					 	'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>');
		}

		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').click(function(){
			$(location).attr('href', href);
		});
		$('#dataConfirmModal').modal('show');
		
		return false;
	});
});