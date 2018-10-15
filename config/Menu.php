<?php

/**
 * Menu Class instance and render menu configuration
 */
class Menu{
    /**
     * @var menu
     * @access private
     */
    private $menu;


    /**
     * @param menu
     * Add menu in admin page
     * using wordpress handler add_action
     */
    public function Menu($menu){
        $this->menu = $menu;
        add_action('admin_menu',array($this, 'fg_config_admin_page'));
    }

    /**
     * Set config in menu page
     * using wordpress add_menu_page
     */
    public function fg_config_admin_page(){
        add_menu_page(
            'Gallery - Image and Video',
            'Iapy Gallery',
            'manage_options',
            'iapy_gallery',
            array($this->menu, 'render'),
            'dashicons-images-alt',
            6
        );
    }
}

?>