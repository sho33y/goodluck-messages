<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('admin_sidebar'); ?>
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $goodluck->id], ['confirm' => __('本当に削除してもよろしいですか?', $goodluck->id)]) ?></li>
    </ul>
</nav>
<div class="goodlucks form large-9 medium-8 columns content">
    <?= $this->Form->create($goodluck, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('編集') ?></legend>
        <?php
            echo $this->Form->control('nickname', ['label' => 'ニックネーム']);
            echo $this->Form->control('title', ['label' => 'タイトル']);
            echo $this->Form->control('message', ['label' => 'メッセージ']);
            if ($goodluck->image_name){
                echo '<img src="' . $this->Url->build('/img/uploads/', true) . $goodluck->image_name . '">';
                echo $this->Form->input('file_before', ['type' => 'hidden', 'value' => $goodluck->image_name]);
                echo $this->Form->input('delete' , ['type' => 'submit', 'name' => 'file_delete', 'value' => 'delete']);
            }
            echo $this->Form->file('image', ['label' => '画像']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
