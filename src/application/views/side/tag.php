<?php
use Oni\Web\Helper;

$baseUrl = $systemConfig['blog']['baseUrl'];
?>
<div class="nx-tag col-4">
    <div class="nx-title">
        <h2><?=Helper::linkTo("{$baseUrl}tag/", 'Tag')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['tag'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=Helper::linkTo("{$baseUrl}tag/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>
