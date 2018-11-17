'use strict';
/**
 * Application Bootstrap
 *
 * @package     PointlessTheme - Nex
 * @author      Scar Wu
 * @copyright   Copyright (c) Scar Wu (http://scar.tw)
 * @link        https://github.com/scarwu/PointlessTheme-Nex
 */

import hljs from 'highlight.js';
import axios from 'axios';
import $ from 'jquery';

function asyncLoad(src) {
    var s = document.createElement('script');

    s.src = src;
    s.async = true;

    var e = document.getElementsByTagName('script')[0];

    e.parentNode.insertBefore(s, e);
}

function replaceElements () {
    $('.nx-container .nx-content a').attr('target', '_blank');
    $('.nx-container .nx-content pre').each(function () {
        hljs.highlightBlock(this);
    });
}

function refreshPageWithoutLoading (url, stateAction = null) {
    $.get(url, function(page) {
        let title = $(page).filter('title').text();
        let container = $(page).find('.nx-container').html();

        document.title = title;
        $(document).find('.nx-container').html(container);

        replaceElements();

        switch (stateAction) {
        case 'push':
            window.history.pushState({
                url: url,
                title: title
            }, title, url);

            break;
        case 'replace':
            window.history.replaceState({
                url: url,
                title: title
            }, title, url);

            break;
        }

        if (undefined !== window._nex.googleAnalytics) {
            window.ga('set', 'location', window.location.href);
            window.ga('send', 'pageview');
        }

        if (undefined !== window._nex.disqusShortname
            && document.getElementById('disqus_thread')) {

            if (undefined === window.DISQUS) {
                asyncLoad('//' + window._nex.disqusShortname + '.disqus.com/embed.js');
            } else {
                window.DISQUS.reset({
                    reload: true,
                    config: function () {
                        this.page.identifier = "disqus_thread";
                        this.page.url = window.location.href;
                    }
                });
            }
        }
    });
}

$(document).ready(function () {
    let url = window.location.pathname;
    let title = document.title;

    window.history.pushState({
        url: url,
        title: title
    }, title, url);

    if (undefined !== window._nex.googleAnalytics) {
        asyncLoad('//www.google-analytics.com/analytics.js');

        window.ga = function() {
            (ga.q = ga.q || []).push(arguments)
        };
        ga.l =+ new Date;

        ga('create', window._nex.googleAnalytics, 'auto');
        ga('send', 'pageview');
    }

    if (undefined !== window._nex.disqusShortname
        && document.getElementById('disqus_thread')) {

        asyncLoad('//' + window._nex.disqusShortname + '.disqus.com/embed.js');
    }

    replaceElements();
});

$(document).on('click', 'a', function (event) {
    if (undefined !== $(this).attr('target')) {
        return;
    }

    event.preventDefault();

    refreshPageWithoutLoading($(this).attr('href'), 'push');
});

window.addEventListener('popstate', (event) => {
    refreshPageWithoutLoading(event.state.url);
});

window.addEventListener('keydown', (event) => {
    switch(event.keyCode) {
    case 37:
    case 72:
        if($('.nx-paginator .nx-prev a')[0] !== undefined) {
            $('.nx-paginator .nx-prev a')[0].click();
        }

        break;
    case 39:
    case 76:
        if($('.nx-paginator .nx-next a')[0] !== undefined) {
            $('.nx-paginator .nx-next a')[0].click();
        }

        break;
    case 74:
        scrollBy(0, 40);

        break;
    case 75:
        scrollBy(0, -40);

        break;
    }
});
