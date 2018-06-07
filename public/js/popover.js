// Script permettant le fonctionnement des popovers.
$(document).ready(function()
{
	$('[data-toggle="popover"]').popover();   
});

// Script permettant la disparition du popover en cliquant n'importe où.
$('body').on('click', function (e) 
{
    if ($(e.target).data('toggle') !== 'popover'
        && $(e.target).parents('[data-toggle="popover"]').length === 0
        && $(e.target).parents('.popover.in').length === 0) 
    { 
        $('[data-toggle="popover"]').popover('hide');
    }
});