<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://raw.github.com/appleboy/jquery.slideShow/master/jquery.slideshow.min.js"></script>
<script>
(function ($) {
    $('.slideShow').slideShow({
        interval: 3,
        start: 'random',
        transition: {
            mode: 'slideshow',
            speed: 800
        }
    });
})(jQuery);
</script>