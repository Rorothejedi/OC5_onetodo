$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function () {
    	$('#sidebarCollapse').toggleClass('is-active');
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $(".activeCollapse").on('click', function(){
		$('.rotate', this).toggleClass("down"); 
	});
});