<?php
/**
 * Smm section for landing
 */

$smmSectionDetails = !empty(get_post_meta(get_post()->ID)['smmSectionDetails'][0]) ?
    get_post_meta(get_post()->ID)['smmSectionDetails'][0] : null;

?>

<?php if (!empty($smmSectionDetails)) : ?>
    <section class="section section5 black">
        <div class="container">
            <h2><?=pll__('СММ')?></h2>
            <div class="lng__block">
                <?php foreach (unserialize($smmSectionDetails) as $item) : ?>
                    <div class="col">
                        <span class="num"><span><?=$item['number']?></span><?=$item['sign']?></span>
                        <p><?=$item['text']?></p>
                    </div>
                <?php endforeach ; ?>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-4.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-5.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-6.png" alt=""></div>
    </section>
<?php endif; ?>
