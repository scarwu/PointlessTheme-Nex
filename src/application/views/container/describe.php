<?php
$disqusShortname = $systemConfig['blog']['disqusShortname'];
?>
<div class="nx-describe">
    <div class="nx-limiter">
        <article class="nx-block">
            <div class="nx-title">
                <h1><?=$container['title']?></h1>
            </div>
            <div class="nx-content"><?=$container['content']?></div>
        </article>
    </div>

    <?php if (null !== $disqusShortname && $container['withMessage']): ?>
    <div class="nx-disqus_thread">
        <div class="nx-limiter">
            <div id="disqus_thread"></div>
        </div>
    </div>
    <?php endif; ?>
</div>