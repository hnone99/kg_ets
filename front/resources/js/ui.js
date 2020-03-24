var Header = Header || {};

+function ($) {
    'use strict';

    Header.el = {};
    Header.init = function() {
        Header.default();
        Header.headerFixed();
        Header.lang();
        Header.siteMap();
        Header.top();
        Header.nav();
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
        Header.el.btnLang = $('#btn-lang');
        Header.el.nav = $('#nav');
        Header.el.title = $('h3.title');
        Header.el.top = $('.btn-top');

        Header._win = Header._win || {};
        Header._headerFixed = Header._headerFixed || {};
        Header._lang = Header._lang || {};
        Header._siteMap = Header._siteMap || {};
        Header._top = Header._top || {};
        Header._nav = Header._nav || {};

        Header._win._wLimit = 992;

        var agent = navigator.userAgent.toLowerCase();
        if ((navigator.appName === 'Netscape' && agent.indexOf('trident') !== -1) || (agent.indexOf("msie") !== -1)) {
            Header.el.html.addClass('ie11');
        }

        if(Header.el.title.length > 0){
            setTimeout(function() {
                Header.el.title.addClass('active');
            }, 850);
        }
    };

    Header.lang = function() {
        var el = Header.el.btnLang;
        Header._lang._isLangOpen = false;
        el.on('click', function(e) {
            e.preventDefault();
            if(!Header._lang._isLangOpen){
                Header._lang.view();
            }else{
                Header._lang.view(true);
            }
        });        
        Header._lang.view = function(b) {
            var bool = (b) ? b : false;
            if(!bool){
                if(!Header._lang._isLangOpen){
                    Header._lang._isLangOpen = true;
                    Header.el.html.addClass('open-lang');
                }
            }else{
                if(Header._lang._isLangOpen){
                    Header._lang._isLangOpen = false;
                    Header.el.html.removeClass('open-lang');
                }
            }
        };
    };

    Header.siteMap = function() {
        var el = Header.el.btnSitemap;
        el.list = Header.el.sitemap.find('.list');
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
        el.list.on('mouseenter',function(e){
            Header.el.sitemap.find('[class^=col-]').removeClass('active');
            $(this).closest('[class^=col-]').addClass('active');
        }).on('mouseleave',function(e){
            Header.el.sitemap.find('[class^=col-]').removeClass('active');
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
        el = el.find('> .container > div > a');
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

    Header.addEvent = function() {
        Header.el.dim.on('click', function(e) {
            e.preventDefault();
            if(Header._search._isOpen){
                Header._search.viewSearch(true);
            }
        });
        Header.el.win.on('resize.header', function() {
            Header.el.html.addClass('is-resize');
            if(Header.el.top.length > 0) Header._top.resize();
            if(Header.el.header.length > 0) Header._headerFixed.resize();
            Header.el.html.removeClass('is-resize');
        }).on('scroll.header', function(e) {
            //Header._didScroll = true;
            if(Header.el.top.length > 0) Header._top.scroll();         
            if(Header.el.header.length > 0) Header._headerFixed.scroll();         
        }).on('click', function(e) {
            if(Header._lang._isLangOpen){
                if(!$(e.target).is('#btn-lang')
                    && $(e.target).parents('#btn-lang').length === 0
                    && !$(e.target).is('.lang-menu')
                    && $(e.target).parents('.lang-menu').length === 0){
                    Header._lang.view(true);
                }
            }
            if(Header._nav._isNavOpen){
                if(!$(e.target).is('#nav a')
                    && $(e.target).parents('#nav a').length === 0){
                    Header.el.nav.find('> .container > div > a').removeClass('active');
                }
            }
        }).trigger('resize.header');
    };

    $(document).ready(function() {
        Header.init();
    });
}(jQuery);