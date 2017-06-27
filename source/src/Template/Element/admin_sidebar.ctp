<ul class="side-nav">
    <span>サイト</span>
        <li><?= $this->Html->link(__('サイト'), ['_name' => 'home'], ['target' => '_blank']) ?></li>
    <span>メッセージ</span>
        <li><?= $this->Html->link(__('メッセージ一覧'), ['controller' => 'goodlucks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('新規メッセージ追加'), ['controller' => 'goodlucks', 'action' => 'add']) ?></li>
</ul>
