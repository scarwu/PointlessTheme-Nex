<?php
use Oni\Web\Helper;

$domainName = $systemConfig['blog']['domainName'];
$baseUrl = $systemConfig['blog']['baseUrl'];
$disqusShortname = $systemConfig['blog']['disqusShortname'];

// Paging
$paging = $container['paging'];
$prevButton = isset($paging['prevUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['prevUrl']}", $paging['prevTitle']) : '';
$nextButton = isset($paging['nextUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['nextUrl']}", $paging['nextTitle']) : '';
$indicator = "{$paging['currentIndex']} / {$paging['totalIndex']}";
?>
<div class="nx-article">
    <div class="nx-limiter">
        <article class="nx-block">
            <div class="nx-title">
                <h1><?=$container['title']?></h1>
                <div class="nx-info">
                    <span class="nx-archive">
                        <?=Helper::linkTo("{$baseUrl}archive/{$container['year']}/", $container['date'])?>
                    </span>
                    &nbsp;/&nbsp;
                    <span class="nx-category">
                        <?=Helper::linkTo("{$baseUrl}category/{$container['category']}/", $container['category'])?>
                    </span>
                    <?php if (0 < count($container['tags'])):?>
                    &nbsp;/&nbsp;
                    <span class="nx-tag">
                        <?=join(' ', array_map(function ($tag) use ($baseUrl) {
                            return Helper::linkTo("{$baseUrl}tag/{$tag}/", $tag);
                        }, $container['tags']))?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="nx-content"><?=$container['content']?></div>
        </article>
    </div>

    <?php if (null !== $disqusShortname && $container['withMessage']): ?>
    <div class="nx-disqus_thread">
        <div class="nx-limiter">
            <div class="nx-block">
                <div id="disqus_thread"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="nx-limiter">
        <div class="nx-paginator row">
            <span class="nx-prev col-xl-6 col-lg-6 col-sm-6 col-12"><?=$prevButton?></span>
            <span class="nx-next col-xl-6 col-lg-6 col-sm-6 col-12"><?=$nextButton?></span>
            <span class="nx-count col-12"><?=$indicator?></span>
        </div>
    </div>
</div>