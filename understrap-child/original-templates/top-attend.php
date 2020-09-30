<div id="room" class="top-section">

    <img src="<?php echo get_the_attendimage_url(); ?>" alt="attend" class="section-img">

    <div class="top-txtarea">

        <p class="section-text"><?php echo get_option('attend_txtarea'); ?></p>

        <div class="page-linkbtn">
            <a href="<?php echo get_option('attend_url'); ?>"><?php echo get_option('attend_button'); ?></a>
        </div>

    </div><!-- /.top-txtarea -->
</div>
