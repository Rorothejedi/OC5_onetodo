<?php

if (!empty($_SESSION['alertSuccess'])) 
{
	echo '<div class="alert alert-success fade show" role="alert">' .

		$_SESSION['alertSuccess'] . 

		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>';

	$_SESSION['alertSuccess'] = null;
} 
elseif (!empty($_SESSION['alertFailure']))
{
	echo '<div class="alert alert-danger fade show" role="alert">' .

		$_SESSION['alertFailure'] . 

		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>';

	$_SESSION['alertFailure'] = null;
}