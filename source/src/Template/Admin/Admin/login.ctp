<style>
    .login-form-wrapper {
        width: 50%;
        margin: 80px auto 0;
    }
    .login-form-wrapper h4 {
        margin-bottom: 20px;
    }
</style>

<div class="login-form-wrapper">
    <h4>管理画面ログイン</h4>

    <?= $this->Form->create(null, ['novalidate' => true]) ?>
    <?= $this->Form->input('username') ?>
    <?= $this->Form->input('password') ?>
    <?= $this->Form->button('ログイン') ?>
    <?= $this->Form->end() ?>
</div>
