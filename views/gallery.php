    <!-- HIDDEN VIDEO REQUIRED IN LIGHTGALLERY -->
    <?php foreach($data as $pred): ?>
    <?php $extension = explode('.',$pred->source);?>
            <?php if(!(in_array($extension[1], array('jpeg', 'png', 'jpg')))): ?>
                <div class="video_hidden" id="video-<?php echo $pred->id ?>" >
                    <video class="lg-video-object lg-html5" controls preload="none">
                        <source src="<?php echo plugin_dir_url(__DIR__)."upload/".$pred->source ?>" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            <?php endif; ?>
    <?php endforeach; ?>
    
    <!-- SHOW GALLERY IN PLUGIN LIGHTGALLERY -->
    <div id="gallery-front">
        <?php foreach($data as $d):?>
            <?php $extension = explode('.',$d->source);?>
            <!-- IF IS IMAGE OR VIDEO -->
            <?php if(in_array($extension[1], array('jpeg', 'png', 'jpg'))): ?>

                <a href="<?php echo plugin_dir_url(__DIR__)."upload/".$d->source ?>">
                    <img src="<?php echo plugin_dir_url(__DIR__)."upload/".$d->source ?>" />
                </a>

            <?php else: ?>

                <a class="video_container" data-sub-html="<?php $d->description ?>" data-html="#video-<?php echo $d->id ?>" >
                    <video src="<?php echo plugin_dir_url(__DIR__)."upload/".$d->source ?>" />
                </a>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>