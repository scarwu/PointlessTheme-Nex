<?php
use Oni\Web\Helper\HTML;

$baseUrl = $blog['config']['baseUrl'];
?>
<div class="nx-archive col-xl-6 col-lg-6 col-md-6 col-12">
    <div class="nx-title">
        <h2><?=HTML::linkTo("{$baseUrl}archive/", 'Archive')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['archive'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=HTML::linkTo("{$baseUrl}archive/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>