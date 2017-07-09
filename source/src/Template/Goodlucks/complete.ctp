<?= $this->start('css'); ?>
<?= $this->Html->css('form'); ?>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home'); ?>

<div class="container">
    <main id="main">
        <div class="inner">
            <div class="form-wrapper">
                <div class="thanks-message">
                    <p>メッセージを送信完了しました。</p>
                    <p>送信したメッセージは<?= $this->Html->link(__('こちら'), ['_name' => 'home']) ?>からご確認いただけます。</p>
                    <p>このメッセージを見てきっと愛美も留学を頑張れると思います。</p>
                    <p>ご協力頂きありがとうございました。</p>
                </div>
            </div>
            <!-- /.form-wrapper -->
        </div>
    </main>
</div>
