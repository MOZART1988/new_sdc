<?php
/* Template Name: СММ Лендинг */
get_header('smm');
?>
<div class="lng" id="fullpage">
    <?php get_template_part('templates/pages/landings/smm/section', 'headerform')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'smmKazakhstan')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'questions') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'videoslider') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'smm') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'advantages') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'doinglist') ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'tarifs'); ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'cases')?>
    <?php get_template_part('templates/pages/landings/smm/section', 'team'); ?>
    <?php get_template_part('templates/pages/landings/smm/section', 'footerform')?>
</div>
<div id="modal--form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4></h4>
            </div>
        </div>
    </div>
</div>
<?php get_footer('empty') ?>