<?php
use Oni\Web\Helper;

$baseUrl = $systemConfig['blog']['baseUrl'];
?>
<div class="nx-category col-4">
    <div class="nx-title">
        <h2><?=Helper::linkTo("{$baseUrl}category/", 'Category')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['category'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=Helper::linkTo("{$baseUrl}category/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>
