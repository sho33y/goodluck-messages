<?= $this->assign('wrapper_class', 'home blog slabtexted'); ?>

<div id="wrapper">
    <!-- Header -->
    <header>
        <h2 class="copy"><a href="http://bokukoto.com">僕らは言葉でできている&nbsp;<span class="info">|&nbsp;心に残る、珠玉のコピー・名言を紹介します。僕らは毎日、笑う。泣く。考える。喧嘩する。謝る。愛を囁く。僕らは言葉でできている。</span></a></h2>
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
