<?php
//require_once(__DIR__.'/../../../../wp-load.php');

class GalleryModel{

    public function GalleryModel(){
    }

    public function insert($data){
        try{
            global $wpdb;
            $inserted_id = [];
            $tablename = $wpdb->prefix.'full_gallery';
            foreach($data as $k => $v){
                $explode_data = explode(',',$v['source']);
                $base64_image = base64_decode($explode_data[1]);
                $explode_string = explode('/',$explode_data[0]);
                $explode_extension = explode(';',$explode_string[1]);
                $extension = $explode_extension[0];
                $filename = uniqid();
                $basePath = plugin_dir_path(__DIR__)."upload/".$filename.'.'.$extension;
                $url = parse_url(plugin_dir_url(__DIR__)."upload/".$filename.'.'.$extension);
                $upload = file_put_contents($basePath, $base64_image);
                $wpdb->insert($tablename, array('source'=>$filename.'.'.$extension, 'description'=>$v['description']), array('%s','%s'));
                array_push($inserted_id,$wpdb->insert_id, $basePath);
            }
            return $inserted_id;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function findAll(){
        try{
            global $wpdb;
            $tablename = $wpdb->prefix.'full_gallery';
            $sql = $wpdb->prepare("SELECT * FROM {$tablename} ORDER BY created_at DESC");
            $results = $wpdb->get_results($sql);
            return $results;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteMedia($id){
        try{
            global $wpdb;
            $tablename = $wpdb->prefix.'full_gallery';
            $source = $wpdb->get_var("SELECT source FROM {$tablename} WHERE id = {$id}");
            $wpdb->delete($tablename, array('id'=>$id));
            $path = plugin_dir_path(__DIR__)."upload/".$source;
            unlink($path);
            return array('id'=>$id, 'path'=>$path);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

}
?>