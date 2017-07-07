<?= $this->start('css'); ?>
<?= $this->Html->css('form'); ?>
<?= $this->end(); ?>
<?= $this->start('script'); ?>
<script type="text/javascript">
    var sent = false;
    function fnCheckSubmit(form, mode) {
        if (sent) {
            alert("只今、処理中です。しばらくお待ち下さい。");
            return false;
        }
        sent = true;
        form.mode.value = mode;
        form.submit();
    }
</script>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home'); ?>

<div class="container">
    <main id="main">
        <div class="inner">
            <div class="form-wrapper">
                <?= $this->Form->create($goodluck, ['class' => 'form-style01']) ?>
                <?php echo $this->Form->hidden('mode', ['value' => 'complete']); ?>
                <!-- エラーメッセージのテンプレート変更 -->
                <?php $this->Form->templates(['error' => '<p>{{content}}</p>']); ?>
                <table class="table01">
                    <tr>
                        <th class="required"><label for="nickname">ニックネーム</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('nickname')){ echo $this->Form->error('nickname'); } ?>
                        </td>
                        <td><?php echo $goodluck->nickname; ?></td>
                    </tr>
                    <tr>
                        <th class="required"><label for="title">タイトル</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('title')){ echo $this->Form->error('title'); } ?>
                        </td>
                        <td><?php echo $goodluck->title; ?></td>
                    </tr>
                    <tr>
                        <th class="required"><label for="message">メッセージ</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('message')){ echo $this->Form->error('message'); } ?>
                        </td>
                        <td>
                            <?php echo nl2br($goodluck->message); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="image">画像</label></th>
                        <td class="message">
                            <?php if ($this->Form->isFieldError('image')){ echo $this->Form->error('image'); } ?>
                        </td>
                        <td>
                            <?php if ($goodluck->image_name): ?>
                                <img src="<?php echo $this->Url->build('/img/uploads/', true) . $goodluck->image_name; ?>" style="max-width: 100%;">
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <!-- /.table01 -->
                <div class="note-area" style="text-align: center; margin-bottom: 10px;">
                    <div class="attention">
                        <p>上記内容をご確認し、よければ送信するボタンを押してください。</p>
                    </div>
                </div>
                <!-- /.note-area -->
                <?= $this->Form->button(__('送信する'), [
                    'type' => 'button',
                    'class' => 'submit-button',
                    'templates' => ['submitContainer' => '{{content}}'],
                    'onclick' => "fnCheckSubmit(this.form, 'complete'); return false;",
                    'label' => false,
                ]) ?>
                <?= $this->Form->button(__('戻る'), [
                    'type' => 'button',
                    'class' => 'submit-button',
                    'templates' => ['submitContainer' => '{{content}}'],
                    'onclick' => "fnCheckSubmit(this.form, 'return'); return false;",
                    'label' => false,
                    'style' => 'margin-top:20px; background:#696969;',
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.form-wrapper -->
        </div>
    </main>
</div>
