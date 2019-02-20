<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 1:12 AM
 */

namespace App\Database\Migrations;


class Book extends \Application\Framework\Database\Table
{
    public function up(){
        parent::increment("id");
        parent::string("title");
        parent::string("isbn", parent::NOT_NULL, 15);
        parent::int("catagory_id");
        parent::int("softcopy_id", parent::NULL);
        parent::boolean("hardcopy");
        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}