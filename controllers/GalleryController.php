<?php

require_once __DIR__.'/../models/GalleryModel.php';

class GalleryController{

    /**
     * Function controller to save images
     */
    public function saveGallery($data){
        if(isset($data)){
            $model = new GalleryModel();
            return $model->insert($data);
        }
    }
    /**
     * Function controller to get all images
     */
    public function getGallery(){
        $model = new GalleryModel();
        return $model->findAll();
    }
    /**
     * Function controller to remove media file and registry in database
     */
    public function removeMedia($id){
        $model = new GalleryModel();
        return $model->deleteMedia($id);
    }

}
?>