<?php

namespace Application\Commander\Action; 

class Migration{
    public function __construct($args)
    {
        $migration_templet = fread(fopen(APPLICATION_ROOT."vendor/Application/Commander/Action/Templets/migration.php", "r"),
        filesize(APPLICATION_ROOT."vendor/Application/Commander/Action/Templets/migration.php"));

        $model_templet = fread(fopen(APPLICATION_ROOT."vendor/Application/Commander/Action/Templets/model.php", "r"),
        filesize(APPLICATION_ROOT."vendor/Application/Commander/Action/Templets/model.php"));

        if(isset($args[3])){
            $migration_templet = str_replace("{table}", $args[3], $migration_templet);
            $model_templet = str_replace("{model}", $args[3], $model_templet);
        }else{
            die("module name and controller name is not supplied"); 
        }

        $new_migration = fopen(APPLICATION_ROOT."/app/Database/Migrations/".$args[3].".php", "w+");
        $new_model = fopen(APPLICATION_ROOT."/app/".$args[3].".php", "w+");

        fwrite($new_migration, $migration_templet);
        fwrite($new_model, $model_templet);
    }
}