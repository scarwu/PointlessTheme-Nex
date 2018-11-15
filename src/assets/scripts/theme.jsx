'use strict';
/**
 * Application Bootstrap
 *
 * @package     PointlessTheme - Unique
 * @author      Scar Wu
 * @copyright   Copyright (c) Scar Wu (http://scar.tw)
 * @link        https://github.com/scarwu/PointlessTheme-Unique
 */

import hljs from 'highlight.js';
import $ from 'jquery';

$('.nx-container .nx-content a').attr('target', '_blank');
$('.nx-container .nx-content pre').each(function () {
    hljs.highlightBlock(this);
});

$(window).keydown(function (e) {
    switch(e.keyCode) {
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
