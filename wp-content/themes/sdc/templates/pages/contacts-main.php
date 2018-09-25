<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 25.09.18
 * Time: 14:38
 */
?>
<div class="col-lg-3 col-md-4">
    <form class="form">
        <h6>Обратная связь:</h6>
        <input type="text" placeholder="Имя" required="required">
        <input type="email" placeholder="Электронная почта" required="required">
        <input type="text" placeholder="Контактный номер телефона" name="tel" required="required">
        <textarea rows="5"></textarea>
        <input type="submit" class="btn" value="Отправить" data-toggle="modal" data-target="#modal--form">
        <div id="modal--form" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4>Ваше письмо отправленно</h4>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-9 col-md-8">
    <div class="row">
        <div class="col-md-6">
            <ul class="contacts__list">
                <li class="contacts__list__phone">
                    <h6>Телефоны:</h6>
                    <a href="tel:+7 (727) 350-57-60">+7 (727) <span>350-57-60</span></a>
                    <a href="tel:+7 (707) 350-57-60">+7 (707) <span>350-57-60</span></a>
                </li>
                <li class="contacts__list__location">
                    <h6>Адрес:</h6>
                    <p>Республика Казахстан 050000<br> г. Алматы, Проспект Абылай Хана 141, офис 320</p>
                </li>
                <li class="contacts__list__email">
                    <h6>Электронная почта:</h6>
                    <a href="mailto:info@sd-c.kz">info@sd-c.kz</a>
                </li>
                <li class="contacts__list__socials">
                    <h6>Мы в соц. сетях :</h6>
                    <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
            </ul>

        </div>
        <div class="col-md-6">
            <h6>Карта проезда:</h6>
            <div class="map" id="map" style="height: 270px;"></div>
        </div>
    </div>
</div>
