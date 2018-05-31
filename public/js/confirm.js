$(function() 
{
	$('button[data-confirm]').click(function() 
	{
		if (!$('#dataConfirmModal').length) 
		{
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' + 
				'<div class="modal-dialog modal-dialog-centered">' + 
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
			$('#main-form').submit();
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
				'<div class="modal-dialog modal-dialog-centered">' + 
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

// Modal de confirmation de suppresion d'un projet
$(function() 
{
	$('button[data-confirm-delete]').click(function() 
	{
		if (!$('#dataConfirmModal').length) 
		{
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' + 
				'<div class="modal-dialog modal-dialog-centered">' + 
					'<div class="modal-content">' +
					 	'<div class="modal-header">' + 
					 		'<h5 id="dataConfirmLabel">Merci de confirmer la suppression</h5>' + 
					 		'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">' + 
					 			' <span aria-hidden="true">&times;</span>' + 
					 		'</button>' +
					 	'</div>' + 
					 	'<div class="modal-body">' + 
					 	'<p>Pour que ce projet soit bien supprimé, veuillez écrire "SUPPRIMER" dans le champ ci-dessous.</p>' +
					 	'<input type="text" id="textConfirmDelete" class="form-control">' +
					 	'</div>' + 
					 	'<div class="modal-footer">' + 
					 		'<button type="button" class="btn btn-danger" id="dataConfirmOK" data-dismiss="modal" aria-hidden="true" disabled>Confirmer</button>' + 
					 		'<button type="button" class="btn btn-secondary" id="removeText" data-dismiss="modal">Annuler</button> ' + 
					 	'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>');
		}
		
		$('#textConfirmDelete').on('input', function() {
			if ($(this).val() == "SUPPRIMER") 
			{
				$(this).attr('disabled', 'disabled');
				$('#dataConfirmOK').removeAttr('disabled');
			}
		});

		$('#removeText').click(function() {
			$('#textConfirmDelete').val('').removeAttr('disabled');
			$('#dataConfirmOK').attr('disabled', 'disabled');
		});
		
		$('#dataConfirmOK').click(function()
		{
			$('#form-delete-project').submit();
		});

		$('#dataConfirmModal').modal('show');
		return false;
	});
});