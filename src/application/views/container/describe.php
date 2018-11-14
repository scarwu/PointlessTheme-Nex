<?php
$disqusShortname = $systemConfig['blog']['disqusShortname'];
?>
<div class="nx-describe">
    <article class="nx-block">
        <div class="nx-title">
            <h1><?=$container['title']?></h1>
        </div>
        <div class="nx-content"><?=$container['content']?></div>
    </article>

    <?php if(null !== $disqusShortname && $container['withMessage']): ?>
    <div id="disqus_thread" class="nx-disqus_thread"></div>
    <?php endif; ?>
</div>