$(function(){

    if ($('.imageSelect').length) {
        $('.imageSelect').chosen({ width:"40%"});
    }


    if ($('#page_template option:selected').val() != 'pageSmm.php') {
        $('#smm-section, #advantages-section, #doing-section').addClass('hidden');
        $('#postdivrich').removeClass('hidden');
    } else {
        $('#postdivrich').addClass('hidden');
    }

    $('#page_template').on('change', function () {
        if ($(this).val() != 'pageSmm.php') {

            $('#smm-section, #advantages-section, #doing-section').addClass('hidden');
            $('#postdivrich').removeClass('hidden');

        } else {

            $('#smm-section, #advantages-section, #doing-section').removeClass('hidden');
            $('#postdivrich').addClass('hidden');

        }
    });
});