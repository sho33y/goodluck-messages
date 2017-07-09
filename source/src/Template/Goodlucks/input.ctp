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
                <div class="note-area">
                    <p>「タイ留学へ旅立つ愛美への応援メッセージ」にご協力頂きありがとうございます。</p>
                    <p>以下の説明をお読みになり必要項目を入力してください。</p>
                    <p>メッセージがどのように表示されるかは<?= $this->Html->link(__('こちら'), ['_name' => 'home'], ['target' => '_blank']) ?>からご確認頂けます。</p>
                    <div class="attention">
                        <ul>
                            <li>もし思い出の写真などがあればぜひメッセージに添付してください。</li>
                            <li>絵文字は使用することができません。</li>
                            <li>一度送信した投稿は自分で変更することはできません。もし変更したい場合は<a href="mailto:kidsdream226@gmail.com?subject=goodluck-manamiについて">こちらへ</a>ご連絡ください。</li>
                        </ul>
                    </div>
                </div>
                <!-- /.note-area -->
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
                                <?php echo $this->Form->input('画像取り消し' , ['type' => 'submit', 'name' => 'file_delete', 'value' => 'delete', 'onclick' => "fnCheckSubmit(this.form, 'img_delete'); return false;"]); ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <?php echo $this->Form->file('image', ['id' => 'image']); ?>
                        </td>
                    </tr>
                </table>
                <!-- /.table01 -->
                <?= $this->Form->button(__('確認画面へ'), [
                    'type' => 'button',
                    'class' => 'submit-button',
                    'templates' => ['submitContainer' => '{{content}}'],
                    'onclick' => "fnCheckSubmit(this.form, 'confirm'); return false;",
                    'label' => false,
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.form-wrapper -->
        </div>
    </main>
</div>
