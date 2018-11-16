<?php
$postfix = time();
$lang = $systemConfig['blog']['lang'];
$slogan = $systemConfig['blog']['slogan'];
$footer = $systemConfig['blog']['footer'];

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
<html class="no-js" style="display: block !important;" lang="<?=$lang?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:description" name="description" content="<?=$description?>">
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:url" content="//<?="{$domainName}{$baseUrl}{$container['url']}"?>">
    <meta property="og:image" content="//<?="{$domainName}{$baseUrl}"?>images/icon.jpg">
    <meta property="og:type" content="blog">

    <title><?=$title?></title>

    <link rel="canonical" href="//<?="{$domainName}{$baseUrl}{$container['url']}"?>">
    <link rel="author" href="//plus.google.com/+ScarWu">
    <link rel="image_src" href="//<?="{$domainName}{$baseUrl}"?>images/icon.jpg">
    <link rel="shortcut icon" href="//<?="{$domainName}{$baseUrl}"?>favicon.ico">
    <link rel="stylesheet" href="<?=$baseUrl?>assets/styles/theme.min.css?<?=$postfix?>">

    <script src="<?=$baseUrl?>assets/scripts/vendor/modernizr.min.js?<?=$postfix?>"></script>
    <script src="<?=$baseUrl?>assets/scripts/theme.min.js?<?=$postfix?>" async></script>

    <script>
        function asyncLoad(src) {
            var s = document.createElement('script');
            s.src = src; s.async = true;
            var e = document.getElementsByTagName('script')[0];
            e.parentNode.insertBefore(s, e);
        }
    </script>
    <?php if(null !== $googleAnalytics): ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?=$googleAnalytics?>', 'auto');
        ga('send', 'pageview');
    </script>
    <?php endif; ?>
</head>
<body>
    <header id="nx-header">
        <div class="nx-limiter">
            <h1 class="nx-title">
                <a href="/">ScarShow</a>
            </h1>
            <h2 class="nx-slogan"><?=$slogan?></h2>

            <form class="nx-search" action="//www.google.com/search?q=as" target="_blank" method="get">
                <input type="hidden" name="q" value="site:<?=$domainName?>">
                <input type="text" name="q" placeholder="Search">
                <input type="submit">
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
        <p class="nx-text"><?=$footer?></p>
        <a class="nx-powered" href="https://github.com/scarwu/Pointless" target="_blank">
            <span>Powered by Pointless</span>
        </a>
    </footer>

    <div id="fb-root"></div>

    <?php if(null !== $disqusShortname): ?>
    <script>
        var disqusShortname = '<?=$disqusShortname?>';
        if (document.getElementsByTagName('disqus_comments')) {
            asyncLoad('//' + disqusShortname + '.disqus.com/count.js');
        }
        if (document.getElementById('disqus_thread')) {
            asyncLoad('//' + disqusShortname + '.disqus.com/embed.js');
        }
    </script>
    <?php endif; ?>
</body>
</html>