<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Goodluck'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="goodlucks index large-9 medium-8 columns content">
    <h3><?= __('Goodlucks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nickname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($goodlucks as $goodluck): ?>
            <tr>
                <td><?= $this->Number->format($goodluck->id) ?></td>
                <td><?= h($goodluck->nickname) ?></td>
                <td><?= h($goodluck->title) ?></td>
                <td><?= h($goodluck->created) ?></td>
                <td><?= h($goodluck->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $goodluck->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $goodluck->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $goodluck->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodluck->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
