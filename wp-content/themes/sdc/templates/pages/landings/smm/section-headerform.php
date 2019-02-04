<?php
/**
 *
 *
 */

$headerSectionTitle = !empty(get_post_meta(get_post()->ID)['header_smm_section_title'][0]) ?
    get_post_meta(get_post()->ID)['header_smm_section_title'][0] : null;
?>
<section class="section section1 red">
    <div class="container">
        <h2><?=$headerSectionTitle?></h2>
        <div class="lng__block">
            <form class="col" id="smmForm">
                <h5><?=pll__('Закажите индивидуальный просчет вашего проекта')?></h5>
                <input type="text" placeholder="<?=!empty($headerSectionTitle['name']) ? $headerSectionTitle['name'] : pll__('Имя')?>" name="smmForm[name]" required>
                <input type="email" placeholder="<?=$headerSectionTitle['email'] ? $headerSectionTitle['email'] : pll__('Электронная почта')?>" name="smmForm[email]" required>
                <input type="text" placeholder="<?=$headerSectionTitle['phone'] ? $headerSectionTitle['phone'] : pll__('Контактный номер телефона')?>" name="smmForm[phone]" required>
                <input type="submit" class="btn" value="<?=pll__('Отправить')?>">
            </form>
            <div class="col">
                <div class="phones__slider wow fadeInUp" data-wow-offset="0">
                    <div><img src="/img/img-61.jpg" alt=""></div>
                    <div><img src="/img/img-61.jpg" alt=""></div>
                    <div><img src="/img/img-61.jpg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-1.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-2.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-3.png" alt=""></div>
</section>
