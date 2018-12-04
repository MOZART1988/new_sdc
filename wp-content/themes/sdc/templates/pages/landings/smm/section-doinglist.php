<?php

global $iconsArray;

$doinglistSectionDetails = get_post_meta(get_post()->ID, 'doinglistSectionDetails')[0];
$counter = 2;

?>
<?php if (!empty($doinglistSectionDetails)): ?>
    <section class="section section7 black">
        <div class="container">
            <h2><?=pll__('Что мы сделаем для вас?')?></h2>
            <div class="lng__block">
                <?php foreach ($doinglistSectionDetails as $item) : ?>
                <div class="col wow fadeIn" data-wow-offset="0" data-wow-delay="0.<?=$counter++?>s">
                    <?=$iconsArray[$item['icon']];?>
                    <p><?=$item['text']?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-4.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-5.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-6.png" alt=""></div>
    </section>
<?php endif; ?>

