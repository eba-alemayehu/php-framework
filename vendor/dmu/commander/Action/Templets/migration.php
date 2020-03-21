<?php
namespace App\Database\Migrations;


class {table}Migration extends \Application\Database\Table
{
    public function up(){
        parent::increment("id");

        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}