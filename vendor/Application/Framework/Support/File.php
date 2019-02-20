<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/19/19
 * Time: 11:59 AM
 */

namespace Application\Framework\Support;


class File
{
    public static function store($file_name, $loc , $save_name = null, $append = false){
        $target_dir = APPLICATION_ROOT."public/storage/".$loc;
        $target_file = "";
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($append){
            $target_file.= ($save_name)? $save_name.".".$file_type: basename($_FILES[$file_name]["name"]);
        }else{
            $target_file.=$save_name.basename($_FILES[$file_name]["name"]);
        }
        $target_file_dir = $target_dir.$target_file;


        move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file_dir);

        return (object)[
            "path"=>$target_dir, "type"=>"",
            "file" => $target_file,
            "file_path" => $target_file_dir,
            "size" =>$_FILES[$file_name]["size"],
            "type" => $file_type,
            "relative_path" => "storage/".$loc,
            "relative_path_file" => "storage/".$loc.$target_file,
        ];
    }
}