<?= $this->start('css'); ?>
<?= $this->Html->css('form'); ?>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home'); ?>

<div class="container">
    <main id="main">
        <div class="inner">
            <div class="form-wrapper">
                <div class="thanks-message">
                    送信完了ページ
                </div>
                <?= $this->Html->link('メッセージ一覧へ', ['_name' => 'home']) ?>
            </div>
            <!-- /.form-wrapper -->
        </div>
    </main>
</div>
