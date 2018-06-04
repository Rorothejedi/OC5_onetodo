// Création de l'objet defilementFluide pour la fonction smoothscroll
var defilementFluide = {

    // Méthode pour initialiser le défilement fluide via les ancres
    init : function() {

        $(document).on('click', 'a[href^="#"]', function (e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
        });
        
        // $("a[href='#top']").click(function() {
        //     $("html, body").animate({ scrollTop: 0 }, 500);
        //     return false;
        // });
    }
};

var top_page = {

    init : function() {

        $(window).scroll(function() {

            if ($(window).scrollTop() > 500) {

                $('.fa-arrow-circle-up').fadeIn();

            } else {
                $('.fa-arrow-circle-up').fadeOut();
            }
        });
    }
}