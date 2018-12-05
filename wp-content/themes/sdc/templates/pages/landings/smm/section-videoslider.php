<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.12.18
 * Time: 14:21
 */

$videoSectionDetails = !empty(get_post_meta(get_post()->ID, 'videoSectionDetails')[0])?
    get_post_meta(get_post()->ID, 'videoSectionDetails')[0] : null;

?>

<?php if (!empty($videoSectionDetails)) : ?>
    <section class="section section4">
        <div class="container">
            <div class="video--for">
                <?php foreach($videoSectionDetails as $item) : ?>
                    <div><iframe width="560"
                                 height="315"
                                 src="<?=$item['video']?>"
                                 frameborder="0"
                                 allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe></div>
                <?php endforeach; ?>
            </div>
            <div class="video--nav not--complete">
                <?php foreach ($videoSectionDetails as $item) : ?>
                    <div><img src="/img/img-62.jpg" alt="img-62"></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bg" data-offset="55"><img src="/img/bg-7.png" alt=""></div>
        <div class="bg" data-offset="10"><img src="/img/bg-8.png" alt=""></div>
        <div class="bg" data-offset="25"><img src="/img/bg-9.png" alt=""></div>
    </section>
<?php endif; ?>

