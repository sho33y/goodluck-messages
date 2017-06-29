<?= $this->start('css'); ?>
<?= $this->Html->css('import'); ?>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home blog slabtexted'); ?>

<div id="wrapper">
    <!-- Header -->
    <header>
        <h2 class="copy"><a href="/">Good luck Manami.&nbsp;<span class="info">|&nbsp;タイ留学へ旅立つ愛美へ&nbsp;みんなからの応援メッセージ</span></a></h2>
    </header>
    <!-- /Header -->
    <!-- Left -->
    <div id="leftContent">

    </div>
    <!-- /Left -->
    <!-- Right -->
    <div id="rightContent">
        <ul class="articleList">
            <?php foreach ($goodlucks as $goodluck): ?>
                <li class="article"><article>
                    <?=
                    $this->Html->link(
                        $this->Html->tag('span', __($goodluck->title, true), ['class' => 'slabtext']),
                        ['action' => 'message', $goodluck->id],
                        ['escape' => false])
                    ?>
                    <aside class="detail">—&nbsp;<?= $goodluck->nickname ?></aside>
                </article></li>
            <?php endforeach; ?>

            <div id="page-nav">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </div>
        </ul>
    </div>
    <!-- /Right -->
    <!-- Footer -->
    <footer>
        <p id="pageTop" style="display: block;"><a href="#wrapper">PAGE TOP</a></p>
    </footer>
    <!-- /Footer -->
</div>
