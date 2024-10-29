
        // Image slideshow
        $(document).ready(function () {
            let currentSlide = 0;
            const slides = $('#slideshow img');
            slides.eq(currentSlide).addClass('active');

            setInterval(function () {
                slides.eq(currentSlide).removeClass('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides.eq(currentSlide).addClass('active');
            }, 3000);
        });

        // Swiper slider
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 6,  // Change this to 6 to show 6 slides at a time
    spaceBetween: 30,
    loop: true,
    navigation: {
        nextEl: '.arrow-right',
        prevEl: '.arrow-left',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>'; // Optionally, customize bullet content
        },
        hideOnClick: true, // This will hide the pagination when clicking on it
    },
    on: {
        init: function () {
            this.pagination.el.style.display = 'none'; // Hide the pagination initially
        },
    },
});

        // Box image slideshow
        $('.box').each(function () {
            var $box = $(this);
            var $slides = $box.find('.box-slideshow img');
            var currentIndex = 0;

            setInterval(function () {
                $slides.eq(currentIndex).removeClass('active');
                currentIndex = (currentIndex + 1) % $slides.length;
                $slides.eq(currentIndex).addClass('active');
            }, 3000);
        });

        

