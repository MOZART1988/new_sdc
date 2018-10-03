<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 01.10.18
 * Time: 16:35
 */

get_header();
?>
<div class="page portfolio--unit"><!-- page content -->
    <?php while(have_posts()) : the_post()?>
        <div class="banner second">
            <?php get_template_part('/templates/categories/clients/clients', 'breadcumps')?>
        </div>
        <div class="container portfolio--container">
            <div class="portfolio--unit__block">
                <div class="portfolio--unit__block__row">
                    <div class="col-lg-10 col-md-9 col-sm-9">
                        <?php the_title('<h1>', '</h1>'); ?>
                        <p><?php the_content(); ?></p>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                        <img src="<?=get_the_post_thumbnail_url($post, 'client-thumb')?>">
                    </div>
                </div>
            </div>
            <h3 class="text-center"><?=pll__('Все работы для компании')?> <?=$post->post_title?></h3>
            <?php get_template_part('templates/categories/portfolio/portfolio_categories', 'index'); ?>
            <div class="portfolio">
                <div class="slider portfolio__for" id="portfolio__for--1">
                    <div>
                        <div class="portfolio__for__col left">
                            <a href="img/img-8.jpg" class="fancy"><img src="img/img-53.jpg"></a>
                        </div>
                        <div class="portfolio__for__col right">
                            <span class="portfolio__for__col__title">Туристическая компания Asirius</span>
                            <span class="portfolio__for__col__task"><strong>Задача:</strong> разработать сайт с минимум информации, но максимум картинок.</span>
                            <a href="#" class="btn">Просмотреть результат</a>
                        </div>
                    </div>
                    <div>
                        <div class="portfolio__for__col left">
                            <a href="img/img-8.jpg" class="fancy"><img src="img/img-53.jpg"></a>
                        </div>
                        <div class="portfolio__for__col right">
                            <span class="portfolio__for__col__title">Туристическая компания Asirius</span>
                            <span class="portfolio__for__col__task"><strong>Задача:</strong> разработать сайт с минимум информации, но максимум картинок.</span>
                            <a href="#" class="btn">Просмотреть результат</a>
                        </div>
                    </div>
                    <div>
                        <div class="portfolio__for__col left">
                            <a href="img/img-8.jpg" class="fancy"><img src="img/img-53.jpg"></a>
                        </div>
                        <div class="portfolio__for__col right">
                            <span class="portfolio__for__col__title">Туристическая компания Asirius</span>
                            <span class="portfolio__for__col__task"><strong>Задача:</strong> разработать сайт с минимум информации, но максимум картинок.</span>
                            <a href="#" class="btn">Просмотреть результат</a>
                        </div>
                    </div>
                </div>
                <div class="portfolio__slider--nav" id="portfolio__nav--1">
                    <div>
                        <span>Сайт</span>
                        <img src="img/img-9.jpg">
                    </div>
                    <div>
                        <span>Сайт</span>
                        <img src="img/img-10.jpg">
                    </div>
                    <div>
                        <span>Сайт</span>
                        <img src="img/img-11.jpg">
                    </div>
                </div>
            </div>
        </div>
        <?=hm_get_template_part('templates/categories/clients/other-clients', ['mainPost' => $post, 'category' => get_the_category()]) ?>
        <form class="portfolio--unit__form second">
            <div class="portfolio--unit__form__title">
                <h3>Хотите заказать проект?</h3>
                <h6>Заполните заявку и мы свяжимся с вами.</h6>
            </div>
            <div class="row">
                <input type="text" placeholder="Имя" required="required" class="half">
                <input type="text" placeholder="Контактный номер телефона" name="tel" required="required" class="half right">
            </div>
            <div class="row">
                <input type="email" placeholder="Электронная почта" required="required" class="half">
                <input type="text" placeholder="Название компании" required="required" class="half right">
            </div>
            <textarea rows="5" placeholder="Расскажите в кратце о своем проекте" required="required"></textarea>
            <div class="portfolio--unit__form__btn">
                <input type="submit" value="Отправить" class="btn" data-target="#modal--portfolio" data-toggle="modal">
            </div>
        </form>
        <div id="modal--portfolio" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4>Ваше письмо отправленно!</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal--call" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4>Заказать обратный звонок</h4>
                        <form>
                            <input type="text" placeholder="Имя" required="required">
                            <input type="text" placeholder="Контактный номер" name="tel" required="required">
                            <textarea rows="5" placeholder="Сообщение" required="required"></textarea>
                            <input type="submit" class="btn" value="Отправить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="call--btn" data-toggle="modal" data-target="#modal--call">
            <span class="bg"></span>
        </a>
        <div class="help">
            <h5>Закажите услугу</h5>
            <p>или получите консультацию</p>
            <span class="close"></span>
        </div>
    <?php endwhile; ?>
</div><!-- page content -->
<?php get_footer(); ?>

