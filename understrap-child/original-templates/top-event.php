<div id="room" class="top-section">

    <img src="<?php echo get_the_eventimage_url(); ?>" alt="ebent イベント" class="section-img">

    <div class="top-txtarea">

        <p class="section-title"><?php echo get_option('event_time'); ?></p>

        <p class="section-text"><?php echo get_option('event_txtarea'); ?></p>

        <div class="page-linkbtn">
            <a href="<?php echo get_option('event_url'); ?>"><?php echo get_option('event_button'); ?></a>
        </div>

    </div><!-- /.top-txtarea -->
</div>
