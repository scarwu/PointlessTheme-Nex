<?php
use Oni\Web\Helper;

$baseUrl = $systemConfig['blog']['baseUrl'];
?>
<div class="nx-archive col-4">
    <div class="nx-title">
        <h2><?=Helper::linkTo("{$baseUrl}archive/", 'Archive')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['archive'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=Helper::linkTo("{$baseUrl}archive/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>