// $(window).load(function(){
//     $('#gallery').rvnGallery();
// });

$(document).ready(function() {

    var lolek = 0;

    $('.slider-nav-next').click(function() {
        if(parseInt($('.images').css('margin-left')) < -580)
        {
            $('.images').animate({marginLeft:'0px'},'fast');
        }
        else if(lolek == 0)
        {
            lolek = 1;
            $('.images').animate({marginLeft:'-=580px'},'slow');
            setInterval(function() { lolek = 0; }, 2500);
        }
    });
    $('.slider-nav-prev').click(function() {
        if(parseInt($('.images').css('margin-left')) < 0)
        {
            if((parseInt($('.images').css('margin-left'))+580) < 0)
            {
                $('.images').animate({marginLeft:'+=580px'},'slow');
            }
            else
            {
                $('.images').animate({marginLeft:'0px'},'slow');
            }
        }
    });

});


// var message = 'Wczytywanie zdjęcia...';
// $(function() {
//     $('.gallery').on('click', 'ul.gallery-thumb a', function(e) {
//         e.preventDefault();
//
//         var galleryFull = $(e.delegateTarget).children('.gallery-full'),
//             imageSrc    = $(this).attr('href'),
//             imageTitle  = $(this).attr('title') || 'Domyślny opis zdjęcia';
//         galleryFull.children('img').attr(
//             {
//                 'src': imageSrc,
//                 'alt': imageTitle
//             }
//         );
//         // zamiast tytułu wstawiamy nasz komunikat
//         galleryFull.children('h1').html(message);
//
//         $(this).parents('ul.gallery-thumb').find('img').removeClass('active');
//         $(this).children('img').addClass('active');
//     });
//     // po pełnym załadowaniu zdjęcia podmieniamy komunikat oczekiwania na tytuł
//     // $('.gallery .gallery-full img').on('load', function() {
//     //     $(this).prev().html($(this).attr('alt'));
//     // });
// });

// $(window).load(function(){
//     var aktor = {
//         // tutaj ustawiamy "przeźroczystość" obrazków
//         opacity : 0.2,
//         // te zmienne odpowiadają za ustawienie tej samej szerokości i wysokości dla 'li' na podstawie wysokości i szerokości obrazków
//         imgWidth : $('.galeria ul li').find('img').width(),
//         imgHeight : $('.galeria ul li').find('img').height()
//     };
//     // ustawia taką samą wysokość i szerokość pozycji w liście jaką mają obrazki
//     $('.galeria ul li').css({ 'width' : aktor.imgWidth, 'height' : aktor.imgHeight });
//     // kiedy kursor jest nad pozycją z listy...
//     $('.galeria ul li').hover(function(){
//         //... znajduje obrazek w tej pozycji i nadaje klasę 'aktywny' i zmienia jego przeźroczystość na 1 (1 to pełna widoczność, a 0 to brak widoczności)
//         $(this).find('img').addClass('aktywny').animate({'opacity' : 1}, 100);
//         // pobiera inne obrazki z listy i ustawia im przeźroczystość o wartości podanej w atrybutach zmiennej aktor oraz animuje przejścia przeźroczystości
//         $(this).siblings('li').find('img').animate({'opacity' : aktor.opacity}, 100)
//         // kiedy kursor zmienia położenie ...
//     }, function(){
//         //... pobierz obrazek z pozcyji opuszczonej i usuń klasę 'aktywny'
//         $(this).find('img').removeClass('aktywny');
//     });
//     // kiedy kursor opuszcza przestrzeń galerii ...
//     $('.galeria ul').bind('mouseleave',function(){
//         // to zmienia przeźroczystość wszystkich obrazków na 1
//         $(this).find('img').animate({'opacity' : 1}, 100);
//     });
// });