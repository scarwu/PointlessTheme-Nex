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
        <div class="nx-info">
            <div class="nx-archive">
                <i class="fa fa-calendar"></i>
                <?=Helper::linkTo("{$baseUrl}archive/{$article['year']}/", $article['date'])?>
            </div>
            <div class="nx-category">
                <i class="fa fa-folder"></i>
                <?=Helper::linkTo("{$baseUrl}category/{$article['category']}/", $article['category'])?>
            </div>
            <?php foreach ($article['tags'] as $index =>  $tag): ?>
            <div class="nx-tag">
                <i class="fa fa-tag"></i>
                <span><?=Helper::linkTo("{$baseUrl}tag/{$tag}/", $tag)?></span>
            </div>
            <?php endforeach; ?>
            <?php if (null !== $disqusShortname && $article['withMessage']): ?>
            <div class="nx-disqus_comments disqus_comments">
                <i class="fa fa-comment"></i>
                <a href="<?=Helper::linkEncode("{$baseUrl}article/{$article['url']}")?>#disqus_thread">0 Comment</a>
            </div>
            <?php endif; ?>
            <!-- <hr /> -->
            <!-- <div class="nx-social_tool">
                <div class="nx-twitter">
                    <a class="twitter-share-button"
                        data-url="http://<?=Helper::linkEncode("{$domainName}{$baseUrl}article/{$article['url']}")?>"
                        data-text="<?="{$article['title']} | {$systemConfig['blog']['name']}"?>"
                        data-lang="en"
                        data-via="xneriscool"></a>
                </div>
                <div class="nx-facebook">
                    <div class="fb-like"
                        data-href="http://<?=Helper::linkEncode("{$domainName}{$baseUrl}article/{$article['url']}")?>"
                        data-layout="button_count"
                        data-action="like"
                        data-show-faces="true"
                        data-share="false"></div>
                </div>
                <div class="nx-google">
                    <div class="g-plusone"
                        data-href="http://<?=Helper::linkEncode("{$domainName}{$baseUrl}article/{$article['url']}")?>"
                        data-size="medium"></div>
                </div>
            </div> -->
        </div>
        <div class="nx-content"><?=$article['summary']?></div>
        <a class="nx-more" href="<?="{$baseUrl}article/{$article['url']}"?>">More</a>
    </article>
    <?php endforeach; ?>

    <div class="nx-paginator">
        <span class="nx-prev"><?=$prevButton?></span>
        <span class="nx-next"><?=$nextButton?></span>
        <span class="nx-count"><?=$indicator?></span>
    </div>
</div>