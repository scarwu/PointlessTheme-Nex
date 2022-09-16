<?php
$postfix = 1663307199670;
$lang = $blog['config']['lang'];
$slogan = $blog['config']['slogan'];
$footer = $blog['config']['footer'];

$protocol = $blog['config']['withSSL'] ? 'https' : 'http';
$domainName = $blog['config']['domainName'];
$baseUrl = $blog['config']['baseUrl'];

$googleAnalytics = $blog['config']['googleAnalytics'];
$disqusShortname = $blog['config']['disqusShortname'];

$title = isset($container['title'])
    ? "{$container['title']} | {$blog['config']['name']}"
    : $blog['config']['name'];
$description = (!isset($container['description']) || '' === $container['description'])
    ? $blog['config']['description']
    : $container['description'];
?>
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
            <?php foreach ($theme['config']['views']['side'] as $name): ?>
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