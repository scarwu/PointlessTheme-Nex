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
    <article class="nx-block">
        <div class="nx-title">
            <h1><?=$container['title']?></h1>
        </div>
        <div class="nx-content"><?=$container['content']?></div>
        <div class="nx-info">
            <div class="nx-archive">
                <i class="fa fa-calendar"></i>
                <?=Helper::linkTo("{$baseUrl}archive/{$container['year']}/", $container['date'])?>
            </div>
            <div class="nx-category">
                <i class="fa fa-folder"></i>
                <?=Helper::linkTo("{$baseUrl}category/{$container['category']}/", $container['category'])?>
            </div>
            <?php foreach ($container['tags'] as $tag): ?>
            <div class="nx-tag">
                <i class="fa fa-tag"></i>
                <?=Helper::linkTo("{$baseUrl}tag/{$tag}/", $tag)?>
            </div>
            <?php endforeach; ?>
            <?php if (null !== $disqusShortname && $container['withMessage']): ?>
            <div class="nx-disqus_comments disqus_comments">
                <i class="fa fa-comment"></i>
                <a href="<?=Helper::linkEncode("{$baseUrl}{$container['url']}")?>#disqus_thread">0 Comment</a>
            </div>
            <?php endif; ?>
            <!-- <hr /> -->
            <!-- <div class="nx-social_tool">
                <div class="nx-twitter">
                    <a class="twitter-share-button"
                        data-url="//<?=Helper::linkEncode("{$domainName}{$baseUrl}{$container['url']}")?>"
                        data-text="<?="{$container['title']} | {$systemConfig['blog']['name']}"?>"
                        data-lang="en"
                        data-via="xneriscool"></a>
                </div>
                <div class="nx-facebook">
                    <div class="fb-like"
                        data-href="//<?=Helper::linkEncode("{$domainName}{$baseUrl}{$container['url']}")?>"
                        data-layout="button_count"
                        data-action="like"
                        data-show-faces="true"
                        data-share="false"></div>
                </div>
                <div class="nx-google">
                    <div class="g-plusone"
                        data-href="//<?=Helper::linkEncode("{$domainName}{$baseUrl}{$container['url']}")?>"
                        data-size="medium"></div>
                </div>
            </div> -->
        </div>
    </article>

    <?php if (null !== $disqusShortname && $container['withMessage']): ?>
    <div id="disqus_thread" class="nx-disqus_thread"></div>
    <?php endif; ?>

    <div class="nx-paginator">
        <span class="nx-prev"><?=$prevButton?></span>
        <span class="nx-next"><?=$nextButton?></span>
        <span class="nx-count"><?=$indicator?></span>
    </div>
</div>