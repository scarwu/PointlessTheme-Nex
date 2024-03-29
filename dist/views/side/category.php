<?php
use Oni\Web\Helper\HTML;

$baseUrl = $blog['config']['baseUrl'];
?>
<div class="nx-category col-xl-6 col-lg-6 col-md-6 col-12">
    <div class="nx-title">
        <h2><?=HTML::linkTo("{$baseUrl}category/", 'Category')?></h2>
    </div>
    <div class="nx-content">
        <?php foreach ($sideList['category'] as $key => $postList): ?>
        <span class="nx-item">
            <?php $count = count($postList); ?>
            <?=HTML::linkTo("{$baseUrl}category/{$key}/", $key)?>
        </span>
        <?php endforeach; ?>
    </div>
</div>
