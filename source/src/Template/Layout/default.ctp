<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <meta content="" name="description">
    <meta name="format-detection" content="telephone=no">
    <!-- External files -->
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('jquery-3.1.1.min.js') ?>
    <?= $this->Html->script('jquery.slabtext.js') ?>
    <?= $this->Html->script('infinite-scroll.pkgd.js') ?>
    <?= $this->Html->script('common.js') ?>
    <?= $this->Html->css('import.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <noscript><style>.noscript{display:block;}</style></noscript>
</head>
<body class="<?php echo $this->fetch('wrapper_class'); ?>">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>
</html>
