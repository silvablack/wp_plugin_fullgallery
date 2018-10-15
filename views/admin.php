<div class="wrap">
    <h1>IAPY Gallery - Image and Video</h1>
    <div class="fg-iapy">
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>&controller=gallery&action=new">
            <input type="file" name="fg_iapy[]" />
            <input type="submit" name="send_images" />
        </form>
        <div id="iapy_preview"></div>
    </div>
</div>