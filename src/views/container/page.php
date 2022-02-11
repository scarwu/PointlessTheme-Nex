<?php
use Oni\Web\Helper\HTML;

$domainName = $blog['config']['domainName'];
$baseUrl = $blog['config']['baseUrl'];
$disqusShortname = $blog['config']['disqusShortname'];

// Paging
$paging = $container['paging'];
$prevButton = isset($paging['prevUrl'])
    ? HTML::linkTo("{$baseUrl}{$paging['prevUrl']}", 'Prev Posts') : '';
$nextButton = isset($paging['nextUrl'])
    ? HTML::linkTo("{$baseUrl}{$paging['nextUrl']}", 'Next Posts') : '';
$indicator = "{$paging['currentIndex']} / {$paging['totalIndex']}";
?>
<div class="nx-page">
    <div class="nx-limiter">
        <?php foreach ($container['list'] as $article): ?>
        <article class="nx-block">
            <div class="nx-title">
                <h1><?=HTML::linkTo("{$baseUrl}article/{$article['url']}", $article['title'])?></h1>
                <div class="nx-info">
                    <span class="nx-archive">
                        <?=HTML::linkTo("{$baseUrl}archive/{$article['year']}/", $article['date'])?>
                    </span>
                    &nbsp;/&nbsp;
                    <span class="nx-category">
                        <?=HTML::linkTo("{$baseUrl}category/{$article['category']}/", $article['category'])?>
                    </span>
                    <?php if (0 < count($article['tags'])):?>
                    &nbsp;/&nbsp;
                    <span class="nx-tag">
                        <?=join(' ', array_map(function ($tag) use ($baseUrl) {
                            return HTML::linkTo("{$baseUrl}tag/{$tag}/", $tag);
                        }, $article['tags']))?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (true === isset($article['coverImage'])): ?>
            <div class="nx-cover-image" style="background-image: url('<?=$article['coverImage']?>')"></div>
            <?php endif; ?>
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