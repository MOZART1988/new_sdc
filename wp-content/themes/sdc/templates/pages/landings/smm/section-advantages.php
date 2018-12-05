<?php
/**
 * Advantages section for Smm Landing
*/

$advantages = !empty(get_post_meta(get_post()->ID, 'advantagesSectionDetails')[0]) ?
    get_post_meta(get_post()->ID, 'advantagesSectionDetails')[0] : null;
$counter = 1;
$counterAnimation = 2;
?>

<?php if (!empty($advantages)) : ?>
    <section class="section section6 red">
        <div class="container">
            <h2><?=pll__('Преимущества рекламы в социальных сетях')?></h2>
            <div class="lng__block">
                <?php foreach (unserialize($advantages) as $item) : ?>
                    <div class="col wow fadeInLeft" data-wow-offset="0" data-wow-delay="0.<?=$counterAnimation++?>s">
                        <span class="num">0<?=$counter++?></span>
                        <h5><?=$item['title']?></h5>
                        <p><?=$item['text']?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-1.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-2.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-3.png" alt=""></div>
    </section>
<?php endif; ?>
