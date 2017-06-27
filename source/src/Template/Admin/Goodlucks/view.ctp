<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Goodluck $goodluck
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Goodluck'), ['action' => 'edit', $goodluck->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Goodluck'), ['action' => 'delete', $goodluck->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodluck->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Goodlucks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Goodluck'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="goodlucks view large-9 medium-8 columns content">
    <h3><?= h($goodluck->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nickname') ?></th>
            <td><?= h($goodluck->nickname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($goodluck->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($goodluck->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($goodluck->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($goodluck->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($goodluck->message)); ?>
    </div>
</div>
