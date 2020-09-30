<div id="room" class="top-section">

    <img src="<?php echo get_the_roomimage_url(); ?>" alt="room お部屋" class="section-img">

    <div class="top-txtarea">

        <?php
        $options = get_option('information_text');
        if ($options['infoCheckbox']) : ?>
            <div class="info-area">
                <p><?php echo esc_html($options['infoText']); ?></p>
            </div>
        <?php endif; ?>

        <p class="section-title"><?php echo get_option('room_time'); ?></p>

        <p class="section-text"><?php echo get_option('room_txtarea'); ?></p>

        <div class="page-linkbtn">
            <a href="<?php echo get_option('room_url'); ?>"><?php echo get_option('room_button'); ?></a>
        </div>

    </div><!-- /.top-txtarea -->
</div>
