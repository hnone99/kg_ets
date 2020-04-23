var Header = Header || {};

+function ($) {
    'use strict';

    Header.el = {};
    Header.init = function() {
        Header.default();
        Header.headerFixed();
        Header.gnb();
        Header.siteMap();
        Header.top();
        Header.nav();
        Header.scrollVisible();
        Header.addEvent();
    };
    Header.default = function() {
        Header.el = Header.el || {};
        Header.el.win = $(window);
        Header.el.html = $('html');
        Header.el.body = $('body');
        Header.el.dim = $('.dim');
        Header.el.headerBlock = $('#header-block');
        Header.el.header = $('#header');
        Header.el.content = $('#content-block');
        Header.el.footer = $('#footer-block');
        Header.el.btnSitemap = $('#btn-sitemap');
        Header.el.sitemap = $('#sitemap');
        Header.el.nav = $('#nav');
        Header.el.gnb = $('#gnb');
        Header.el.title = $('h3.title');
        Header.el.jumbotron = $('.jumbotron');
        Header.el.visual = $('#visual');
        Header.el.top = $('.btn-top');
        Header.el.depth1 = $('[data-depth1]');
        Header.el.depth2 = $('[data-depth2]');
        Header.el.depth3 = $('[data-depth3]');

        Header._win = Header._win || {};
        Header._headerFixed = Header._headerFixed || {};
        Header._siteMap = Header._siteMap || {};
        Header._top = Header._top || {};
        Header._nav = Header._nav || {};
        Header._gnb = Header._gnb || {};

        Header._win._wLimit = 992;
        Header._elHeight = Header.el.header.height();

        Header.el.depth1Text = Header.el.depth1.text();
        Header.el.depth2Text = Header.el.depth2.text();
        Header.el.depth3Text = Header.el.depth3.text();

        var agent = navigator.userAgent.toLowerCase();
        if ((navigator.appName === 'Netscape' && agent.indexOf('trident') !== -1) || (agent.indexOf("msie") !== -1)) {
            Header.el.html.addClass('ie11');
        }
        
        if(Header.el.visual.length > 0){
            setTimeout(function() {
                Header.el.visual.addClass('active');
            }, 500);
        }
        if(Header.el.title.length > 0){
            setTimeout(function() {
                Header.el.title.addClass('active');
            }, 500);
        }

        $('[data-toggle="popover"]').popover({
            trigger: 'focus'
        });
        
        $('[data-datepicker]').datepicker({
            dateFormat: "yy-mm-dd"
        });
    };

    Header.siteMap = function() {
        var el = Header.el.btnSitemap;        
        Header._siteMap._isOpen = false;
       
        el.on('click', function(e) {
            e.preventDefault();
            if(!Header._siteMap._isOpen){
                Header._siteMap._isOpen = true;
                Header.el.html.addClass('open-sitemap');
            }else{
                Header._siteMap._isOpen = false;
                Header.el.html.removeClass('open-sitemap');
            }
        });

        el.list = Header.el.sitemap.find('.list');
        Header.el.gnb.find('ul.row').clone().appendTo(Header.el.sitemap.find('.container'));  

        el.list.on('mouseenter',function(e){
            Header.el.sitemap.find('.depth1').removeClass('active');
            $(this).closest('.depth1').addClass('active');
        }).on('mouseleave',function(e){
            Header.el.sitemap.find('.depth1').removeClass('active');
        });
    };

    Header.headerFixed = function() {
        var el = Header.el.header;
        if(el.length === 0) return;
        Header._headerFixed.resize = function() {
            Header._headerFixed.scroll();
        };
        Header._headerFixed.scroll = function() {
            // if(Header.el.win.width() < Header._win._wLimit) return;
            Header._scrollTop = Header.el.win.scrollTop();
            if(Header._scrollTop > el.outerHeight()){
                if(!Header.el.html.hasClass('header-fixed')) Header.el.html.addClass('header-fixed');
            }else{
                if(Header.el.html.hasClass('header-fixed')) Header.el.html.removeClass('header-fixed');
            }
        };        
    };    

    Header.top = function() {
        var el = Header.el.top;
        if(el.length === 0) return;
        el.El = el.find('a');
        el.El.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 500);
        });
        Header._top.resize = function() {
            Header._top.scroll();
        };
        Header._top.scroll = function() {
            // if(Header.el.win.width() < Header._win._wLimit) return;
            Header._scrollTop = Header.el.win.scrollTop();
            if(Header._scrollTop > 0){
                if(!el.hasClass('active')) el.addClass('active');
            }else{
                if(el.hasClass('active')) el.removeClass('active');
            }
        };
    };

    Header.nav = function() {
        var el = Header.el.nav;
        el = el.find('.focus');

        if(Header.el.depth1.length > 0){
            var dataMenu = Header.el.depth1.attr('data-menu');
            Header.el.nav.addClass(dataMenu); 
            if(Header.el.depth1.attr('data-menu') === 'util'){
                Header.el.html.addClass('util-pages');
            }
            else{
                Header.el.gnb.find('.depth1').clone().appendTo(Header.el.nav.find('.dep1 ul'));
            }
            Header.el.nav.find('.dep1 .ing').text(Header.el.depth1Text);
        }
        if(Header.el.depth2.length > 0){
            Header.el.nav.find('.dep2').show();
            Header.el.nav.find('.dep2 .ing').text(Header.el.depth2Text);
            Header.el.gnb.find('.depth1.active .list > li').clone().appendTo(Header.el.nav.find('.dep2 ul'));
        }
        if(Header.el.depth3.length > 0){
            Header.el.nav.find('.dep3').show();
            Header.el.nav.find('.dep3 .ing').text(Header.el.depth3Text);
            Header.el.gnb.find('.list > li.active li').clone().appendTo(Header.el.nav.find('.dep3 ul'));
        }

        Header._nav._isNavOpen = false;       
        el.on('click', function(e) {
            e.preventDefault();
            Header._nav._isNavOpen = true;
            if($(this).hasClass('active')){
                el.removeClass('active')
            }else{
                el.removeClass('active');
                $(this).addClass('active');
            }
        });
    };

    Header.gnb = function() {
        var el = Header.el.gnb;
        el.navItem = el.find('.depth1');
        el.navItemEl = el.navItem.find('> a');
        el.subMenu = el.find('.list');
        el.subMenuEl = el.subMenu.find('> li > a');

        el.navItemEl.each(function(idx,element){
            if($(this).text() === Header.el.depth1Text){
                $(element).closest('.depth1').addClass('active');
                $(element).closest('.depth1').find('.list > li > a').each(function(idx,el){
                    if($(this).text() === Header.el.depth2Text){
                        $(this).closest('li').addClass('active');
                    }
                });
            }
        });
        el.subMenuEl.each(function(idx){
            if($(this).text() === Header.el.depth1Text){
                $(this).addClass('active');
            }
        });
        
        Header._gnb._isOpen = false;
        Header._gnb._isSubMenuOpen = false;
        el.on('mouseenter', function(e) {
            Header.el.html.addClass('header-over');
        }).on('mouseleave', function(e) {
            Header.el.html.removeClass('header-over');
            Header._gnb.viewNav(true);
        });
        el.navItem.on('mouseenter', function(e) {
            var $el = $(e.currentTarget);
            if(Header._gnb._isOpen) return;
            Header._gnb.viewNav();
        });
        el.navItem.on('mouseleave', function(e) {
            var $el = $(e.currentTarget);
            Header._gnb.viewNav(true);
        });
        Header._gnb.viewNav = function(b) {
            var bool = (b) ? b : false;
            if(!bool){
                if(!Header._gnb._isOpen){
                    Header._gnb._isOpen = true;
                    Header.el.html.addClass('open-gnb-sub');
                }
            }else{
                if(Header._gnb._isOpen){
                    Header.el.html.removeClass('open-gnb-sub');
                    Header._gnb._isOpen = false;
                }
            }
        };
    };

    Header.scrollVisible = function() {
        var $win = $(window);
        var _scrollTop = 0;
        var $article = $('[scroll-visible]'); 
        $win.on('scroll.contents', function() {
            _scrollTop = $win.scrollTop();
            $.each($article, function(i, el) {
                var $el = $(el);
                if($('#main').length > 0){
                    if(_scrollTop > $el.offset().top - $win.height() / 1){
                        $el.addClass('showup');
                    }                    
                }
                else{
                    if(_scrollTop > $el.offset().top - $win.height() / 2){
                        $el.addClass('showup');
                    }
                }
                
            });
        }).trigger('scroll.contents');
    };

    Header.addEvent = function() {
        Header._scrollTop = 0;
        Header._exScrollTop = null;
        Header._didScroll = false;

        Header.mainScroll = function() {
            Header._scrollTop = Header.el.win.scrollTop();
            Header.scroll();
            Header._exScrollTop = Header._scrollTop;
        };
        
        Header.scroll = function() {
            if(Header._exScrollTop === null) return;
            if(Header._exScrollTop > Header._scrollTop){
                Header.el.html.removeClass('hide-gnb');
            }else{
                if(Header._scrollTop > Header._elHeight){
                    Header.el.html.addClass('hide-gnb');
                }
            }
        };
        setInterval(function() {
            if(Header._didScroll){
                Header.mainScroll();
                Header._didScroll = false;
            }
        }, 250);

        Header.el.win.on('resize.header', function() {
            Header.el.html.addClass('is-resize');
            if(Header.el.top.length > 0) Header._top.resize();
            if(Header.el.header.length > 0) Header._headerFixed.resize();
            Header.el.html.removeClass('is-resize');
        }).on('scroll.header', function(e) {
            Header._didScroll = true;
            if(Header.el.top.length > 0) Header._top.scroll();         
            if(Header.el.header.length > 0) Header._headerFixed.scroll();         
        }).on('click', function(e) {
            if(Header._nav._isNavOpen){
                if(!$(e.target).is('#nav a')
                    && $(e.target).parents('#nav a').length === 0){
                    Header.el.nav.find('.focus').removeClass('active');
                }
            }
        }).trigger('resize.header').trigger('scroll.header');        
    };

    $(document).ready(function() {
       
        // 퍼블리싱 include
        // 개발시 삭제 필요
        $('#header-block').load('../../../content/_include/header.html')
        $('#footer-block').load('../../../content/_include/footer.html')
        $('#nav-block').load('../../../content/_include/nav.html')

        // 개발시 setTimeout 삭제 필요
        setTimeout(function(){
            Header.init();
        },50);
    });
}(jQuery);