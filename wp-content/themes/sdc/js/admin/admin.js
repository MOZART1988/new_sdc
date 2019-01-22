$(function(){

    if ($('.imageSelect').length) {
        $('.imageSelect').chosen({ width:"40%"});
    }


    if ($('#page_template option:selected').val() != 'pageSmm.php') {
        $('#smm-section, #advantages-section, #doing-section, #team-section, #video-section, #header-smm-section, #smm-kazakhstan-section').addClass('hidden');
        $('#postdivrich').removeClass('hidden');
    } else {
        $('#postdivrich').addClass('hidden');
    }

    $('#page_template').on('change', function () {
        if ($(this).val() != 'pageSmm.php') {

            $('#smm-section, #advantages-section, #doing-section, #team-section, #video-section, #header-smm-section, #smm-kazakhstan-section').addClass('hidden');
            $('#postdivrich').removeClass('hidden');

        } else {

            $('#smm-section, #advantages-section, #doing-section, #team-section, #header-smm-section, #smm-kazakhstan-section').removeClass('hidden');
            $('#postdivrich').addClass('hidden');

        }
    });
});