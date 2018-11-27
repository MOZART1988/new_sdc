$(function(){

    if ($('#page_template option:selected').val() != 'pageSmm.php') {
        $('#smm-section').addClass('hidden');
        $('#postdivrich').removeClass('hidden');
    } else {
        $('#postdivrich').addClass('hidden');
    }

    $('#page_template').on('change', function () {
        if ($(this).val() != 'pageSmm.php') {

            $('#smm-section').addClass('hidden');
            $('#postdivrich').removeClass('hidden');

        } else {

            $('#smm-section').removeClass('hidden');
            $('#postdivrich').addClass('hidden');

        }
    });
});