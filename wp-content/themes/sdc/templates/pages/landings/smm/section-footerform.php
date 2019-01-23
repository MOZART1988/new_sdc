<?php
$footerFormData = get_post_meta( $post->ID , 'footer_smm_section', true);


?>
<section class="section section11">
    <div class="container">
        <h2><?=pll__('Расскажите о своем проекте')?></h2>
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <form id="++++">
                    <input type="text" placeholder="<?=pll__('Имя')?>" required name="formFooterSmm[name]">
                    <input type="text" placeholder="<?=pll__('Контактный телефон')?>" required name="formFooterSmm[phone]">
                    <input type="email" placeholder="<?=pll__('электронная почта')?>" required name="formFooterSmm[email]">
                    <textarea rows="1" placeholder="<?=pll__('Опишите ваш проект, либо интересующую вас услугу')?>" name="formFooterSmm[message]" required></textarea>
                    <input type="submit" class="btn" value="<?=pll__('Отправить')?>">
                </form>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12">
                <ul>
                    <li>
                        <span class="name"><?=pll__('Телефон:')?></span>
                        <a href="tel:+7 727 350-57-60"><?=!empty($footerFormData['phone']) ? $footerFormData['phone'] : ''?></a>
                    </li>
                    <li>
                        <span class="name"><?=pll__('Электронная почта:')?></span>
                        <a href="mailto:info@smartdigital.kz"><?=!empty($footerFormData['email']) ? $footerFormData['email'] : ''?></a>
                    </li>
                    <li>
                        <span class="name"><?=pll__('Место нахождения:')?></span>
                        <?=!empty($footerFormData['adress']) ? $footerFormData['adress'] : ''?>
                    </li>
                    <li>
                        <span class="name"><?=pll__('Порекомендуйте нас своим друзьям:')?></span>
                        <ul class="socials">
                            <li class="vk"><a href="#" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
                            <li class="face"><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="you"><a href="#" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-7.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-8.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-9.png" alt=""></div>
</section>
