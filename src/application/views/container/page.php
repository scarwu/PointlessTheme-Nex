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
    <?php foreach ($container['list'] as $article): ?>
    <article class="nx-block">
        <div class="nx-title">
            <h1><?=Helper::linkTo("{$baseUrl}article/{$article['url']}", $article['title'])?></h1>
        </div>
        <div class="nx-content"><?=$article['summary']?></div>
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
        <div class="nx-more">
            <a href="<?="{$baseUrl}article/{$article['url']}"?>">
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
    </article>
    <?php endforeach; ?>

    <div class="nx-paginator">
        <span class="nx-prev"><?=$prevButton?></span>
        <span class="nx-next"><?=$nextButton?></span>
        <span class="nx-count"><?=$indicator?></span>
    </div>
</div>