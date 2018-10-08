<?php
/**
 * Template for requet project from different pages
*/
?>
<form class="portfolio--unit__form second" name="sendProjectForm" id="sendProjectForm">
    <div class="portfolio--unit__form__title">
        <h3><?=pll__('Хотите заказать проект?')?></h3>
        <h6><?=pll__('Заполните заявку и мы свяжимся с вами.')?></h6>
    </div>
    <div class="row">
        <input name="sendProjectForm[name]" type="text" placeholder="<?=pll__('Имя')?>" required="required" class="half">
        <input name="sendProjectForm[tel]" type="text" placeholder="<?=pll__('Контактный номер телефона')?>" required="required" class="half right">
    </div>
    <div class="row">
        <input name="sendProjectForm[email]" type="email" placeholder="<?=pll__('Электронная почта')?>" required="required" class="half">
        <input name="sendProjectForm[company]" type="text" placeholder="<?=pll__('Название компании')?>" required="required" class="half right">
    </div>
    <textarea name="sendProjectForm[message]" rows="5" placeholder="<?=pll__('Расскажите в кратце о своем проекте')?>" required="required"></textarea>
    <div class="portfolio--unit__form__btn">
        <input type="submit" value="<?=pll__('Отправить')?>" class="btn" />
    </div>
</form>
<div id="modal--portfolio" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="send-project-result"></h4>
            </div>
        </div>
    </div>
</div>