// OFERTAS CSS
$('#carouselExample').on('slide.bs.carousel', function (e) {
    var $e = $(e.relatedTarget);
    
    var idx = $e.index();
    console.log("IDX :  " + idx);
    
    var itemsPerSlide = 8;
    var totalItems = $('.oferta').length;
    
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.oferta').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.oferta').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});