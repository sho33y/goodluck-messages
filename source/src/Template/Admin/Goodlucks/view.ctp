<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('admin_sidebar'); ?>
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $goodluck->id]) ?> </li>
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $goodluck->id], ['confirm' => __('本当に削除してもよろしいですか?', $goodluck->id)]) ?> </li>
    </ul>
</nav>
<div class="goodlucks view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($goodluck->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ニックネーム') ?></th>
            <td><?= h($goodluck->nickname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('タイトル') ?></th>
            <td><?= h($goodluck->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('登録日時') ?></th>
            <td><?= h($goodluck->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('更新日時') ?></th>
            <td><?= h($goodluck->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('メッセージ') ?></h4>
        <?= $this->Text->autoParagraph(h($goodluck->message)); ?>
    </div>
    <div class="row">
        <h4><?= __('画像') ?></h4>
        <?php if ($goodluck->image_name): ?>
            <img src="<?php echo $this->Url->build('/img/uploads/', true) . $goodluck->image_name; ?>">
        <?php endif; ?>
    </div>
</div>
