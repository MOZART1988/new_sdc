<?php
/**
 * template for displaing call phone form
 */
?>
<div id="modal--call" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4><?=pll__('Заказать обратный звонок')?></h4>
                <form name="requestPhoneForm" id="requestPhoneForm">
                    <input type="text" placeholder="<?=pll__('Имя')?>" required="required" name="requestPhoneForm[name]">
                    <input type="text" placeholder="<?=pll__('Контактный номер')?>" name="requestPhoneForm[tel]" required="required">
                    <textarea rows="5" placeholder="<?=pll__('Сообщение')?>" name="requestPhoneForm[message]" required="required"></textarea>
                    <input type="submit" class="btn" value="<?=pll__('Отправить')?>">
                </form>
            </div>
        </div>
    </div>
</div>
<a href="#" class="call--btn" data-toggle="modal" data-target="#modal--call">
    <span class="bg"></span>
</a>
<div class="help">
    <h5><?=pll__('Закажите услугу')?></h5>
    <p><?=pll__('или получите консультацию')?></p>
    <span class="close"></span>
</div>
