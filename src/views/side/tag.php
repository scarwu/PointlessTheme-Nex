<?php
use Oni\Web\Helper\HTML;

$baseUrl = $blog['config']['baseUrl'];
?>
<div class="nx-tag col-12">
    <div class="nx-title">
        <h2><?=HTML::linkTo("{$baseUrl}tag/", 'Tag')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['tag'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=HTML::linkTo("{$baseUrl}tag/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>
