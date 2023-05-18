<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php foreach ($DATA['slider'] as $item) { ?>
            <div class="swiper-slide">
                <img src="<?= $DATA['http_domain'] ?>public/img.slider/<?= $item['slider_imagen'] ?>?last=<?= $item['slider_last'] ?>" alt="Imagen <?= $item['slide_id'] ?> del slider">
            </div>
        <?php } ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <!-- <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div> -->

    <!-- If we need scrollbar -->
    <!-- <div class="swiper-scrollbar"></div> -->
</div>