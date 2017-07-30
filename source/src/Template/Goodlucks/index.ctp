<?= $this->start('css'); ?>
<?= $this->Html->css('jquery.bxslider'); ?>
<?= $this->Html->css('import'); ?>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'home blog slabtexted'); ?>

<div id="wrapper">
    <!-- Header -->
    <header>
        <h2 class="copy"><a href="/">Good luck Manami.&nbsp;|&nbsp;タイ留学へ旅立つ愛美へ&nbsp;みんなからの応援メッセージ</a></h2>
    </header>
    <!-- /Header -->

    <div class="slider-area">
        <ul class="bxslider">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <?php $slider = 'sliders/slider'.$sliderNums[$i].'.jpg' ?>
                <li><img src="<?= $this->Url->image($slider) ?>" alt="思い出<?= $i ?>"></li>
            <?php endfor; ?>
        </ul>
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
