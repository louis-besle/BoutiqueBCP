<?php
namespace App\Models;

class SiteModel extends Model {

    /**
     * SiteModel constructor.
     * 
     * @param mixed $connection The database connection. If null, a new FileDatabase connection will be created.
     */
    public function __construct($connection = null) {
        if(is_null($connection)) {
            $this->connection = new FileDatabase('articles', ['nom','prix','description']);
        } else {
            $this->connection = $connection;
        }
    }

    public function getArticles(){
        return $this->connection->getAllRecords();
    }
}