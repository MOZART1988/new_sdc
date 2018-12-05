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
<!--<div class="preloader show">
    <div class="preloader__block"></div>
    <span class="preloader__title"><?=$category->name?></span>
</div>-->
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
        <!--<div class="slider direction__slider">
            <div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-23.png">
                            <h5>Digital – стратегия</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-24.png">
                            <h5>SMM-продвижение</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-27.png">
                            <h5>Контент</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-28.png">
                            <h5>Видеопродакшен</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-23.png">
                            <h5>Digital – стратегия</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-24.png">
                            <h5>SMM-продвижение</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-27.png">
                            <h5>Контент</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-28.png">
                            <h5>Видеопродакшен</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-23.png">
                            <h5>Digital – стратегия</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-24.png">
                            <h5>SMM-продвижение</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-27.png">
                            <h5>Контент</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-28.png">
                            <h5>Видеопродакшен</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-23.png">
                            <h5>Digital – стратегия</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-24.png">
                            <h5>SMM-продвижение</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-27.png">
                            <h5>Контент</h5>
                        </a>
                    </div>
                    <div class="coll">
                        <a href="#" class="direction__slider__col">
                            <img src="img/img-28.png">
                            <h5>Видеопродакшен</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="slider direction__slider">
            <?php if ($loop->have_posts()) : ?>
                <?php $counterPost = wp_count_posts('direction_item'); ?>
                <?php $counter = 1; ?>
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php if ($counter === 1) : ?>
                        <div>
                    <?php endif; ?>
                    <?php if ($counter % 4 === 0) : ?>
                        </div>
                        <div>
                    <?php elseif($counter === $counterPost->publish - 1): ?>
                        </div>
                    <?php endif; ?>
                    <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div>


