<?php
/* Template Name: СММ Лендинг */
get_header('smm');
?>
<div class="lng" id="fullpage">
    <?php get_template_part('templates/pages/landings/smm/section', 'headerform')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'smmKazakhstan')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'questions') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'videoslider') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'smm') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'advantages') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'doinglist') ?>
    <section class="section section8">
        <div class="container">
            <h2>Готовые пакеты</h2>
            <div class="lng__block">
                <div class="col wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
                    <h5>Тариф «Трафик»</h5>
                    <ul class="circle--list">
                        <li>Создание аккаунта Instagram</li>
                        <li>Оформление описания, настройка бизнес аккаунта, интеграция с WhatsApp</li>
                        <li>Анализ вашего бизнеса, определение стратегии продвижения</li>
                        <li>Разработка до 5 рекламных постов для таргетированной рекламы</li>
                        <li>Настройка оптимизация и ведение таргетированной рекламы</li>
                        <li>Набор от 1500 живых подписчиков в Ваш аккаунт через массфоловинг</li>
                    </ul>
                    <div class="lng__block__price">
                        <span class="price">43 000 тг/месяц</span>
                        <a href="#" class="btn">Выбрать</a>
                    </div>
                </div>
                <div class="col wow fadeInUp" data-wow-offset="0" data-wow-delay="0.5s">
                    <h5>Тариф «Трафик+»</h5>
                    <ul class="circle--list">
                        <li>Создание аккаунта Instagram</li>
                        <li>Оформление описания, настройка бизнес аккаунта, интеграция с WhatsApp</li>
                        <li>Анализ вашего бизнеса, определение стратегии продвижения</li>
                        <li>Разработка до 5 рекламных постов для таргетированной рекламы</li>
                    </ul>
                    <div class="lng__block__price">
                        <span class="price">55 000 тг/месяц</span>
                        <a href="#" class="btn">Выбрать</a>
                    </div>
                </div>
                <div class="col wow fadeInUp" data-wow-offset="0" data-wow-delay="0.7s">
                    <h5>Тариф <br> «Комплексное <br> продвижение»</h5>
                    <ul class="circle--list">
                        <li>Создание аккаунта Instagram</li>
                        <li>Оформление описания, настройка бизнес аккаунта, интеграция с WhatsApp</li>
                    </ul>
                    <div class="lng__block__price">
                        <span class="price">70 000 тг/месяц</span>
                        <a href="#" class="btn">Выбрать</a>
                    </div>
                </div>
                <div class="col wow fadeInUp" data-wow-offset="0" data-wow-delay="0.9s">
                    <h5>Тариф <br> «Комплексное <br> продвижение+»</h5>
                    <ul class="circle--list">
                        <li>Создание аккаунта Instagram</li>
                        <li>Оформление описания, настройка бизнес аккаунта, интеграция с WhatsApp</li>
                        <li>Анализ вашего бизнеса, определение стратегии продвижения</li>
                        <li>Разработка до 5 рекламных постов для таргетированной рекламы</li>
                        <li>Настройка оптимизация и ведение таргетированной рекламы</li>
                        <li>Набор от 1500 живых подписчиков в Ваш аккаунт через массфоловинг</li>
                    </ul>
                    <div class="lng__block__price">
                        <span class="price">90 000 тг/месяц</span>
                        <a href="#" class="btn">Выбрать</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-7.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-8.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-9.png" alt=""></div>
    </section>
    <?php get_template_part('templates/pages/landings/smm/section', 'cases')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'team'); ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'footerform')?>
</div>
<div id="modal--form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4></h4>
            </div>
        </div>
    </div>
</div>
<?php get_footer('empty') ?>