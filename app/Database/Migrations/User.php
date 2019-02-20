<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 1:12 AM
 */

namespace App\Database\Migrations;


class User extends \Application\Framework\Database\Table
{
    public function up(){
        parent::increment("id");
        parent::string("username");
        parent::string("firstname");
        parent::string("fathername");
        parent::string("gfathername");
        parent::string("email");
        parent::string("profile_pic", parent::NULL);
        parent::string("gender",parent::NOT_NULL, 6 );
        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}