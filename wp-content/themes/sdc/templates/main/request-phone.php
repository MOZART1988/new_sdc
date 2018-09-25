<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 25.09.18
 * Time: 11:45
 */
?>
<div id="modal--call" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4>Заказать обратный звонок</h4>
                <form name="requestPhoneForm" id="requestPhoneForm">
                    <input type="text" placeholder="Имя" required="required" name="requestPhoneForm[name]">
                    <input type="text" placeholder="Контактный номер" name="requestPhoneForm[tel]" required="required">
                    <textarea rows="5" placeholder="Сообщение" name="requestPhoneForm[message]" required="required"></textarea>
                    <input type="submit" class="btn" value="Отправить">
                </form>
            </div>
        </div>
    </div>
</div>
