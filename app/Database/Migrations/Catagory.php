<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 1:12 AM
 */

namespace App\Database\Migrations;


class Catagory extends \Application\Framework\Database\Table
{
    public function up(){
        parent::increment("id");
        parent::string("name");
        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}