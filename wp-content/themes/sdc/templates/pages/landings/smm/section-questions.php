<?php


$sectionData = !empty(get_post_meta(get_post()->ID)['smm_section_questions'][0]) ?
    unserialize(get_post_meta(get_post()->ID)['smm_section_questions'][0]) : null;



$header = !empty($sectionData['header']) ? $sectionData['header'] : '';

$columnsData = !empty($sectionData['items']) ? $sectionData['items'] : null;

?>
<section class="section section3 red">
    <div class="container">
        <h2><?=$header?></h2>
        <div class="efficacy">
            <?php if (!empty($columnsData) && is_array($columnsData)) : ?>
                <?php foreach ($columnsData as $item) : ?>
                    <div>
                        <div class="efficacy__block">
                            <span class="num"><?=$item['number']?></span>
                            <div class="col">
                                <div>
                                    <?=$item['title']?>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <?=$item['text']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-7.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-8.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-9.png" alt=""></div>
</section>
