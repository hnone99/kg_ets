// ------------- VARIABLES ------------- //
var ticking = false;
var isFirefox = (/Firefox/i.test(navigator.userAgent));
var isIe = (/MSIE/i.test(navigator.userAgent)) || (/Trident.*rv\:11\./i.test(navigator.userAgent));
var scrollSensitivitySetting = 30; //Increase/decrease this number to change sensitivity to trackpad gestures (up = less sensitive; down = more sensitive) 
var slideDurationSetting = 600; //Amount of time for which slide is "locked"
var currentSlideNumber = 0;
var totalSlideNumber = $(".background").length;

// ------------- DETERMINE DELTA/SCROLL DIRECTION ------------- //
function parallaxScroll(evt) {
    if (isFirefox) {
        //Set delta for Firefox
        delta = evt.detail * (-120);
    } else if (isIe) {
        //Set delta for IE
        delta = -evt.deltaY;
    } else {
        //Set delta for all other browsers
        delta = evt.wheelDelta;
    }

    if (ticking != true) {
        if (delta <= -scrollSensitivitySetting) {
            //Down scroll
            ticking = true;
            if (currentSlideNumber !== totalSlideNumber - 1) {
                currentSlideNumber++;
                nextItem();
            }
            slideDurationTimeout(slideDurationSetting);
        }
        if (delta >= scrollSensitivitySetting) {
            //Up scroll
            ticking = true;
            if (currentSlideNumber !== 0) {
                currentSlideNumber--;
            }
            previousItem();
            slideDurationTimeout(slideDurationSetting);
        }
    }
}

// ------------- SET TIMEOUT TO TEMPORARILY "LOCK" SLIDES ------------- //
function slideDurationTimeout(slideDuration) {
    setTimeout(function () {
        ticking = false;
    }, slideDuration);
}

// ------------- ADD EVENT LISTENER ------------- //
var mousewheelEvent = isFirefox ? "DOMMouseScroll" : "wheel";
//window.addEventListener(mousewheelEvent, _.throttle(parallaxScroll, 60), false);

// ------------- SLIDE MOTION ------------- //
function nextItem() {
    var $previousSlide = $(".background").eq(currentSlideNumber - 1);
    $previousSlide.removeClass("up-scroll").addClass("down-scroll");
}

function previousItem() {
    var $currentSlide = $(".background").eq(currentSlideNumber);
    $currentSlide.removeClass("down-scroll").addClass("up-scroll");
}

$(window).scroll(function () {
    if ($(window).scrollTop() > 0) {
        $('html').addClass('is-sticky');
    } else {
        $('html').removeClass('is-sticky');
    }
})

$(window).on('load',function () {
    var swiper = new Swiper('#swiper-products', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination-products',
            type: 'progressbar',
        },
    });

    if ($('#swiper-jumbotron .swiper-slide').length === 1) {
        setTimeout(function () {
            $('#swiper-jumbotron .swiper-slide .float-title').addClass('active');
        }, 100);
    }
    if ($('#swiper-jumbotron .swiper-slide').length > 1) {
        var interleaveOffset = 0.6;
        var mainSwiper = new Swiper('#swiper-jumbotron', {
            autoplay: {
                delay: 5000,
            },
            loop: true,
            speed: 500,
            grabCursor: true,
            watchSlidesProgress: true,
            pagination: {
                el: '.swiper-pagination-jumbotron',
                type: 'bullets',
                clickable: true
            },
            on: {
                progress: function () {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        var slideProgress = swiper.slides[i].progress;
                        var innerOffset = swiper.width * interleaveOffset;
                        var innerTranslate = slideProgress * innerOffset;
                        swiper.slides[i].querySelector(".swiper-item").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },
                touchStart: function () {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = "";
                    }
                },
                setTransition: function (speed) {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = speed + "ms";
                        swiper.slides[i].querySelector(".swiper-item").style.transition =
                            speed + "ms";
                    }
                },
                transitionStart: function () {
                    var swiper = this;
                },
                transitionEnd: function () {
                    var swiper = this;
                    $('#swiper-jumbotron .content-title').removeClass('active');
                    $('#swiper-jumbotron .content-subtitle').removeClass('active');
                    $('.swiper-slide-active').find('.content-title').addClass('active');
                    $('.swiper-slide-active').find('.content-subtitle').addClass('active');
                }
            }
        });

    }

    $('#btn-sitemap').on('click',function(){
        $('html').addClass('sitemap-open');
    });
    $('#btn-sitemap-close').on('click',function(){
        $('html').removeClass('sitemap-open');
    });
});