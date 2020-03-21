<?php
namespace App\Database\Migrations;


class UserMigration extends \Application\Database\Table
{
    public function up(){
        parent::increment("id");
        parent::string('name'); 
        parent::string('email'); 
        parent::int('age'); 
        parent::date('dob'); 
        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}