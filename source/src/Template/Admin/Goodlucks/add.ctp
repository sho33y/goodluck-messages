<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('admin_sidebar'); ?>
</nav>
<div class="goodlucks form large-9 medium-8 columns content">
    <?= $this->Form->create($goodluck, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('新規メッセージ追加') ?></legend>
        <?php
            echo $this->Form->control('nickname', ['label' => 'ニックネーム']);
            echo $this->Form->control('title', ['label' => 'タイトル']);
            echo $this->Form->control('message', ['label' => 'メッセージ']);
            echo $this->Form->file('image', ['label' => '画像']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
