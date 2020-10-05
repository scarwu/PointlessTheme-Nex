<?php
$postfix = 1601876044759;
$lang = $systemConfig['blog']['lang'];
$slogan = $systemConfig['blog']['slogan'];
$footer = $systemConfig['blog']['footer'];

$protocol = $systemConfig['blog']['withSSL'] ? 'https' : 'http';
$domainName = $systemConfig['blog']['domainName'];
$baseUrl = $systemConfig['blog']['baseUrl'];

$googleAnalytics = $systemConfig['blog']['googleAnalytics'];
$disqusShortname = $systemConfig['blog']['disqusShortname'];

$title = isset($container['title'])
    ? "{$container['title']} | {$systemConfig['blog']['name']}"
    : $systemConfig['blog']['name'];
$description = (!isset($container['description']) || '' === $container['description'])
    ? $systemConfig['blog']['description']
    : $container['description'];
?>
<!doctype html>
<html lang="<?=$lang?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:description" name="description" content="<?=$description?>">
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:url" content="<?=$protocol?>://<?="{$domainName}{$baseUrl}{$container['url']}"?>">
    <meta property="og:image" content="<?=$protocol?>://<?="{$domainName}{$baseUrl}"?>images/icon.jpg">
    <meta property="og:type" content="website">

    <title><?=$title?></title>

    <link rel="canonical" href="<?=$protocol?>://<?="{$domainName}{$baseUrl}{$container['url']}"?>">
    <link rel="author" href="<?=$protocol?>://plus.google.com/+ScarWu">
    <link rel="image_src" href="<?=$protocol?>://<?="{$domainName}{$baseUrl}"?>images/icon.jpg">
    <link rel="shortcut icon" href="<?=$protocol?>://<?="{$domainName}{$baseUrl}"?>favicon.ico">
    <link rel="stylesheet" href="<?=$baseUrl?>assets/styles/theme.min.css?<?=$postfix?>">

    <script src="<?=$baseUrl?>assets/scripts/theme.min.js?<?=$postfix?>" async></script>
    <script>
        window._nx = {
            googleAnalytics: <?=(null !== $googleAnalytics) ? "'{$googleAnalytics}'" : 'undefined'?>,
            disqusShortname: <?=(null !== $disqusShortname) ? "'{$disqusShortname}'" : 'undefined'?>
        };
    </script>
</head>
<body>
    <header id="nx-header">
        <div class="nx-limiter">
            <h1 class="nx-title"><a href="/">ScarShow</a></h1>
            <h2 class="nx-slogan"><?=htmlentities($slogan)?></h2>

            <form class="nx-search" action="<?=$protocol?>://www.google.com/search?q=as" target="_blank" method="get">
                <input type="hidden" name="q" value="site:<?=$domainName?>" />
                <input type="text" name="q" placeholder="Search" />
                <input type="submit" />
            </form>
        </div>
    </header>

    <div id="nx-body">
        <div class="nx-container">
            <?=$this->loadContent()?>
        </div>

        <div class="nx-limiter">
            <div class="nx-side row">
                <?php foreach ($themeConfig['views']['side'] as $name): ?>
                <?=$this->loadPartial("side/{$name}")?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer id="nx-footer">
        <p class="nx-text"><?=htmlentities($footer)?></p>
        <a class="nx-powered" href="https://github.com/scarwu/Pointless" target="_blank">
            <span>Powered by Pointless</span>
        </a>
    </footer>
</body>
</html>