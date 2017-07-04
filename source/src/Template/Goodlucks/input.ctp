<?= $this->start('css'); ?>
<?= $this->Html->css('form'); ?>
<?= $this->end(); ?>
<?= $this->start('script'); ?>
<script type="text/javascript">
    var sent = false;
    function fnCheckSubmit(form) {
        if (sent) {
            alert("只今、処理中です。しばらくお待ち下さい。");
            return false;
        }
        sent = true;
        form.submit();
    }
</script>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home'); ?>

<div class="container">
    <main id="main">
        <div class="inner">
            <div class="form-wrapper">
                <?= $this->Form->create($goodluck, ['class' => 'form-style01', 'enctype' => 'multipart/form-data']) ?>
                <?php echo $this->Form->hidden('mode', ['value' => 'confirm']); ?>
                <!-- エラーメッセージのテンプレート変更 -->
                <?php $this->Form->templates(['error' => '<p>{{content}}</p>']); ?>
                <table class="table01">
                    <tr>
                        <th class="required"><label for="nickname">ニックネーム</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('nickname')){ echo $this->Form->error('nickname'); } ?>
                        </td>
                        <td><?php echo $this->Form->text('nickname', ['id' => 'nickname']); ?></td>
                    </tr>
                    <tr>
                        <th class="required"><label for="title">タイトル</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('title')){ echo $this->Form->error('title'); } ?>
                        </td>
                        <td><?php echo $this->Form->text('title', ['id' => 'title']); ?></td>
                    </tr>
                    <tr>
                        <th class="required"><label for="message">メッセージ</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('message')){ echo $this->Form->error('message'); } ?>
                        </td>
                        <td>
                            <?php echo $this->Form->textarea('message', ['cols' => 30, 'rows' => 30]); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="image">画像</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('image')){ echo $this->Form->error('image'); } ?>
                        </td>
                        <?php if ($goodluck->image_name): ?>
                            <td>
                                <img src="<?php echo $this->Url->build('/img/uploads/', true) . $goodluck->image_name; ?>" style="max-width: 100%;">
                                <?php echo $this->Form->input('file_before', ['type' => 'hidden', 'value' => $goodluck->image_name]); ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <?php echo $this->Form->file('image', ['id' => 'image']); ?>
                        </td>
                    </tr>
                </table>
                <!-- /.table01 -->
                <div class="note-area">
                    <div class="attention">
                        <p>ここに注意書きが入ります。</p>
                    </div>
                </div>
                <!-- /.note-area -->
                <?= $this->Form->button(__('確認画面へ'), [
                    'type' => 'button',
                    'class' => 'submit-button',
                    'templates' => ['submitContainer' => '{{content}}'],
                    'onclick' => "fnCheckSubmit(this.form); return false;",
                    'label' => false,
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.form-wrapper -->
        </div>
    </main>
</div>
