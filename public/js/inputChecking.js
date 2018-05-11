function checkPseudo(input, text)
{
	input.on('input', function()
	{
		if ($(this).val().length >= 2 && $(this).val().length <= 25)
		{
			$(this).addClass('is-valid').removeClass('is-invalid');
			text.removeClass('text-muted').addClass('text-success').removeClass('text-danger');
		}
		else
		{
			$(this).addClass('is-invalid').removeClass('is-valid');
			text.removeClass('text-muted').addClass('text-danger').removeClass('text-success');
		}
	});
}

function checkEmail(input, text)
{
	var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

	input.on('input', function()
	{
		if (regex.test(input.val()))
		{
			$(this).addClass('is-valid').removeClass('is-invalid');
			text.removeClass('text-muted').addClass('text-success').removeClass('text-danger');
		}
		else
		{
			$(this).addClass('is-invalid').removeClass('is-valid');
			text.removeClass('text-muted').addClass('text-danger').removeClass('text-success');
		}
	});
}

function checkPass(input, confirmInput, text)
{
	var regex = /^(?:\d+[a-z]|[a-z]+\d)[a-z\d]*$/;

	input.on('input', function()
	{
		if ($(this).val().length >= 8 && regex.test(input.val()))
		{
			$(this).addClass('is-valid').removeClass('is-invalid');
			confirmInput.addClass('is-valid').removeClass('is-invalid');
			text.removeClass('text-muted').addClass('text-success').removeClass('text-danger');
		}
		else
		{
			$(this).addClass('is-invalid').removeClass('is-valid');
			confirmInput.addClass('is-invalid').removeClass('is-valid');
			text.removeClass('text-muted').addClass('text-danger').removeClass('text-success');
		}
	});

	confirmInput.on('input', function() 
	{
		if (input.val() === confirmInput.val()) 
		{
			$(this).addClass('is-valid').removeClass('is-invalid');
			confirmInput.addClass('is-valid').removeClass('is-invalid');
			text.removeClass('text-muted').addClass('text-success').removeClass('text-danger');
		}
		else
		{
			$(this).addClass('is-invalid').removeClass('is-valid');
			confirmInput.addClass('is-invalid').removeClass('is-valid');
			text.removeClass('text-muted').addClass('text-danger').removeClass('text-success');
		}
	});
}

checkPseudo($('#username'), $('.small_username'));
checkEmail($('#email'), $('.small_email'));
checkPass($('#password'), $('#confirm_password'), $('.small_pass'));