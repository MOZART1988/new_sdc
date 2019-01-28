<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 28.01.19
 * Time: 12:18
 */

$counter = 2;


$smmSectionTarifs = get_post_meta(get_post()->ID, 'smmSectionTarifs', true);

?>

<section class="section section8">
    <div class="container">
        <h2><?=pll__('Готовые пакеты')?></h2>
        <?php if (!empty($smmSectionTarifs) && is_array($smmSectionTarifs)) : ?>
            <div class="lng__block">
                <?php foreach ($smmSectionTarifs as $item) : ?>
                    <div class="col wow fadeInUp" data-wow-offset="0" data-wow-delay="0.<?=$counter?>s">
                        <h5><?=$item['name']?></h5>
                        <?=$item['text']?>
                        <div class="lng__block__price">
                            <span class="price"><?=$item['prise']?></span>
                            <a href="#" class="btn"><?=pll__('Выбрать')?></a>
                        </div>
                    </div>
                    <?php $counter+=2; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-7.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-8.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-9.png" alt=""></div>
</section>
