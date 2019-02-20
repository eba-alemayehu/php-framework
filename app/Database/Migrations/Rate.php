<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 1:12 AM
 */

namespace App\Database\Migrations;


class Rate extends \Application\Framework\Database\Table
{
    public function up(){
        parent::increment("id");
        parent::int("user_id");
        parent::int("book_id");
        parent::int("rate", parent::NOT_NULL, 5);
        // createed at and updated at
        parent::datetime("created_at", parent::NULL);
        parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
    }
}