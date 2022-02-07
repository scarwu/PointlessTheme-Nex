<?php
use Oni\Web\View\Helper;

$baseUrl = $systemConfig['blog']['baseUrl'];

// Paging
$paging = $container['paging'];
$prevButton = isset($paging['prevUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['prevUrl']}", $paging['prevTitle']) : '';
$nextButton = isset($paging['nextUrl'])
    ? Helper::linkTo("{$baseUrl}{$paging['nextUrl']}", $paging['nextTitle']) : '';
$indicator = "{$paging['currentIndex']} / {$paging['totalIndex']}";
?>
<div class="nx-archive">
    <div class="nx-limiter">
        <article class="nx-block">
            <div class="nx-title">
                <h1><?=$container['title']?></h1>
            </div>
            <div class="nx-list">
                <?php foreach ($container['list'] as $article): ?>
                <section class="nx-sub-block">
                    <div class="nx-sub-title">
                        <h2><?=Helper::linkTo("{$baseUrl}article/{$article['url']}", $article['title'])?></h2>
                        <div class="nx-info">
                            <span>
                                <?=Helper::linkTo("{$baseUrl}archive/{$article['year']}/", $article['date'])?>
                            </span>
                            &nbsp;/&nbsp;
                            <span>
                                <?=Helper::linkTo("{$baseUrl}category/{$article['category']}/", $article['category'])?>
                            </span>
                            &nbsp;/&nbsp;
                            <span>
                                <?=join(' ', array_map(function ($tag) use ($baseUrl) {
                                    return Helper::linkTo("{$baseUrl}tag/{$tag}/", $tag);
                                }, $article['tags']))?>
                            </span>
                        </div>
                    </div>
                </section>
                <?php endforeach; ?>
            </div>
        </article>
    </div>

    <div class="nx-limiter">
        <div class="nx-paginator row">
            <span class="nx-prev col-xl-6 col-lg-6 col-sm-6 col-12"><?=$prevButton?></span>
            <span class="nx-next col-xl-6 col-lg-6 col-sm-6 col-12"><?=$nextButton?></span>
            <span class="nx-count col-12"><?=$indicator?></span>
        </div>
    </div>
</div>