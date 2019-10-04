<?php
/**
 */

$sectionData = !empty(get_post_meta(get_post()->ID)['smm_section_kazakhstan'][0]) ?
    unserialize(get_post_meta(get_post()->ID)['smm_section_kazakhstan'][0]) : null;



$headerOne = !empty($sectionData['header_one']) ? $sectionData['header_one'] : '';
$headerTwo = !empty($sectionData['header_two']) ? $sectionData['header_two'] : '';

$resultOne = !empty($sectionData['result_one']) ? $sectionData['result_one'] : '';
$resultTwo = !empty($sectionData['result_two']) ? $sectionData['result_two'] : '';

$columnsData = !empty($sectionData['items']) ? $sectionData['items'] : null;

$columnsDataOne = [];
$columnsDataTwo = [];

if ($columnsData !== null && is_array($columnsData)) {
    foreach ($columnsData as $item) {
        if ((int)$item['type'] === 1) {
            $columnsDataOne[] = $item['text'];
        } else {
            $columnsDataTwo[] = $item['text'];
        }
    }
}

?>
<section class="section section2 black">
    <div class="container">
        <h2><?=pll__('Как представляют SMM в Казахстане?')?></h2>
        <div class="row">
            <div class="col-sm-6 wow fadeIn" data-wow-offset="0" data-wow-delay="0.3">
                <?php if (!empty($columnsDataOne) && is_array($columnsDataOne)) : ?>
                    <div class="col">
                        <h3><?=$headerOne?></h3>
                        <ul class="check--list">
                            <?php foreach ($columnsDataOne as $item) : ?>
                                <li><?=$item?></li>
                            <?php endforeach ; ?>
                        </ul>
                    </div>
                    <div class="result">
                        <span class="stiker green"><?=pll__('Результат')?></span>
                        <p><?=$resultOne?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 wow fadeIn" data-wow-offset="0" data-wow-delay="0.6s">
                <?php if (!empty($columnsDataTwo) && is_array($columnsDataTwo)) : ?>
                    <div class="col">
                        <h3><?=$headerTwo?></h3>
                        <ul class="check--list">
                            <?php foreach ($columnsDataTwo as $item) : ?>
                                <li><?=$item?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="result">
                        <span class="stiker green"><?=pll__('Результат')?></span>
                        <p><?=$resultTwo?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-4.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-5.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-6.png" alt=""></div>
</section>
