<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 25.09.18
 * Time: 14:38
 */
$xCoord = get_theme_mod('map_x_coordinate', 43.244768);
$yCoord = get_theme_mod('map_y_coordinate', 76.942429);
$description = get_theme_mod('address', 'Республика Казастан 050000<br>г.Алматы, ул.Абылай Хана 141,<br>офис 320');
?>
<div class="col-lg-3 col-md-4">
    <form class="form" name="sendContactForm" id="sendContactForm">
        <h6><?=pll__('Обратная связь:')?></h6>
        <input type="text" placeholder="<?=pll__('Имя')?>" required="required" name="sendContactForm[name]">
        <input type="email" placeholder="<?=pll__('Электронная почта')?>" required="required" name="sendContactForm[email]">
        <input type="text" placeholder="<?=pll__('Контактный номер телефона')?>" name="sendContactForm[tel]" required="required">
        <textarea rows="5" required="required" name="sendContactForm[message]"></textarea>
        <input type="submit" class="btn" value="<?=pll__('Отправить')?>" />
        <div id="modal--form" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4 id="result-message-ajax"><?=pll__('Ваше письмо отправленно')?></h4>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-9 col-md-8">
    <div class="row">
        <div class="col-md-6">
            <?php the_content(); ?>
        </div>
        <div class="col-md-6">
            <h6><?=pll__('Карта проезда:')?></h6>
            <div class="map" data-x="<?=$xCoord?>" data-y="<?=$yCoord?>" id="map" style="height: 270px;"></div>
            <div id="map-address" style="display: none;">
                <?=$description?>
            </div>
        </div>
    </div>
</div>
