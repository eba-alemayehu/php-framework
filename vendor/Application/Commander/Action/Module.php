<?php

namespace Application\Commander\Action; 

class Module{
    private $_module_dirs= ["Http",
            "Routes",
            "Http/Controllers",
            "Http/Middelwares",
            "Database",
            "Database/Migrations",
            "Resource",
            "Resource/assets", 
            "Resource/assets/js", 
            "Resource/assets/scss"];

    public function __construct($_args){
        if(!isset($_args[3])){
            echo "Module name is not spacified"; 
        }
        $module_name = $_args[3]; 
        // die(APP_DIR."/app/Modules/".$module_name); 
        if(mkdir(APP_DIR."/app/Modules/".$module_name, 0755, true)){
            
            foreach($this->_module_dirs as $dir){
                mkdir(APP_DIR."/app/Modules/$module_name/".$dir, 0755, true); 
            }

            //$this->_make_routes($module_name); 
        }else{
            echo "Directory couldn't not be created"; 
        }
    }

    private function _make_routes($module_name){
        $web = fopen(APP_DIR."/app/Modules/$module_name/Routs/api.php", "w"); 
        $api = fopen(APP_DIR."/app/Modules/$module_name/Routs/web.php", "w"); 

        $web_route_templet = fread(fopen("Templets/router.templete.php", "r"), filesize("Templets/router.templete.php")); 
        $api_route_templet = fread(fopen("Templets/api_router.templete.php", "r"), filesize("Templets/api_router.templete.php"));
        
        fwrite($web, $web_route_templet); 
        fwrite($api, $api_route_templet); 
    }
}