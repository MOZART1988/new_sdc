<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.12.18
 * Time: 10:53
 */

global $membersArray;
global $membersTitlesArray;

$teamSectionDetails = !empty(get_post_meta(get_post()->ID, 'teamSectionDetails')[0]) ?
    get_post_meta(get_post()->ID, 'teamSectionDetails')[0] : null;
$counter = 2;
?>
<?php if (!empty($teamSectionDetails) && is_array($teamSectionDetails)) : ?>
    <section class="section section10 black">
        <div class="container">
            <h2><?=pll__('Почему SMM?')?></h2>
            <div class="lng__block">
                <?php foreach ($teamSectionDetails as $item) : ?>
                    <div class="col wow fadeInRight" data-wow-offset="0" data-wow-delay="0.<?=$counter++?>s">
                        <div class="img"><?=$membersArray[$item['member']]?></div>
                        <span class="title"><?=$membersTitlesArray[$item['member']]?></span>
                        <div>
                            <?=$item['text']?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-4.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-5.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-6.png" alt=""></div>
    </section>
<?php endif; ?>

