<?= $this->start('css'); ?>
<?= $this->Html->css('import'); ?>
<?= $this->end(); ?>
<?= $this->assign('wrapper_class', 'single single-post single-format-standard slabtexted'); ?>

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
        <!-- Article -->
        <article>
            <div class="catch"><span class="slabtext"><?= $goodluck->title ?></span></div>
            <!-- Wonderful -->
            <aside class="why">
                <p class="comment"><?php echo nl2br($goodluck->message) ?></p>
            </aside>
            <?php if ($goodluck->image_name): ?>
                <aside class="message-img">
                    <img src="<?php echo $this->Url->build('/img/uploads/', true) . $goodluck->image_name; ?>" alt="">
                </aside>
            <?php endif; ?>
            <!-- /Wonderful -->
        </article>
        <!-- /Article -->
    </div>
    <!-- /Right -->
    <!-- Footer -->
    <footer>
        <p id="pageTop"><a href="#wrapper">PAGE TOP</a></p>
    </footer>
    <!-- /Footer -->
</div>

