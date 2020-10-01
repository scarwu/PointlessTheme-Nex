<?php
use Oni\Web\Helper;

$domainName = $systemConfig['blog']['domainName'];
$baseUrl = $systemConfig['blog']['baseUrl'];
$disqusShortname = $systemConfig['blog']['disqusShortname'];

// Paging
$paging = $container['paging'];
$prevButton = isset($paging['prevUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['prevUrl']}", 'Prev Posts') : '';
$nextButton = isset($paging['nextUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['nextUrl']}", 'Next Posts') : '';
$indicator = "{$paging['currentIndex']} / {$paging['totalIndex']}";
?>
<div class="nx-page">
    <div class="nx-limiter">
        <?php foreach ($container['list'] as $article): ?>
        <article class="nx-block">
            <div class="nx-title">
                <h1><?=Helper::linkTo("{$baseUrl}article/{$article['url']}", $article['title'])?></h1>
                <div class="nx-info">
                    <span class="nx-archive">
                        <?=Helper::linkTo("{$baseUrl}archive/{$article['year']}/", $article['date'])?>
                    </span>
                    &nbsp;/&nbsp;
                    <span class="nx-category">
                        <?=Helper::linkTo("{$baseUrl}category/{$article['category']}/", $article['category'])?>
                    </span>
                    <?php if (0 < count($article['tags'])):?>
                    &nbsp;/&nbsp;
                    <span class="nx-tag">
                        <?=join(' ', array_map(function ($tag) use ($baseUrl) {
                            return Helper::linkTo("{$baseUrl}tag/{$tag}/", $tag);
                        }, $article['tags']))?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="nx-content"><?=$article['summary']?></div>
            <div class="nx-more">
                <a class="fas fa-chevron-down" href="<?="{$baseUrl}article/{$article['url']}"?>"></a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <div class="nx-limiter">
        <div class="nx-paginator row">
            <span class="nx-prev col-xl-6 col-lg-6 col-sm-6 col-12"><?=$prevButton?></span>
            <span class="nx-next col-xl-6 col-lg-6 col-sm-6 col-12"><?=$nextButton?></span>
            <span class="nx-count col-12"><?=$indicator?></span>
        </div>
    </div>
</div>