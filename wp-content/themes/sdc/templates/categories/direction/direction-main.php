<?php
/**
 * template for displaing direction category
 * @var array $template_args
 */

$category = $template_args['category'];
$loop = $template_args['loop'];
/**
 * @var WP_Query $loop
 * @var WP_Term $categpry
 */

?>
<div class="preloader show">
    <div class="preloader__block"></div>
    <span class="preloader__title"><?=$category->name?></span>
</div>
<div class="page"><!-- main content -->
    <section class="direction"><!-- main direction -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title"><?=$category->name?></h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=$category->category_description?></h3>
                </div>
            </div>
        </div>
        <div class="slider direction__slider">
            <?php if ($loop->have_posts()) : ?>
                <?php $counter = 1; $result = [];?>
                <?php $counterPost = wp_count_posts('direction_item'); ?>
                <?php while($loop->have_posts()) : $loop->the_post();  ?>
                    <?php if ($counter === 2 || $counter === 3 || $counter === 5 || $counter === 6)  : ?>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                    <?php endif; ?>
                    <?php if ($counter === 1)  :?>
                        <div>
                        <table>
                        <tr>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                    <?php elseif ($counter === 4) : ?>
                        </div>
                        <div class="row">
                        <?php get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );?>
                    <?php elseif ($counter === (int)$counterPost->publish || $counter === 9) : ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <div>
                <table>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-23.png">
                                <h5>Digital – стратегия</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-24.png">
                                <h5>SMM-продвижение</h5>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-27.png">
                                <h5>Контент</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-28.png">
                                <h5>Видеопродакшен</h5>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-25.png">
                                <h5>СЕО-продвижение</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-26.png">
                                <h5>Контекстно-медийная сеть</h5>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-29.png">
                                <h5>Email - маркетинг</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-30.png">
                                <h5>Копирайтинг</h5>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-23.png">
                                <h5>Digital – стратегия</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-24.png">
                                <h5>SMM-продвижение</h5>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-27.png">
                                <h5>Контент</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-28.png">
                                <h5>Видеопродакшен</h5>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-25.png">
                                <h5>СЕО-продвижение</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-26.png">
                                <h5>Контекстно-медийная сеть</h5>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-29.png">
                                <h5>Email - маркетинг</h5>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="direction__slider__col">
                                <img src="img/img-30.png">
                                <h5>Копирайтинг</h5>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section><!-- main direction -->
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
</div><!-- main content -->
