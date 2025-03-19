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
            $this->connection = new FileDatabase('entreprises', ['nom','secteur','ville']);
        } else {
            $this->connection = $connection;
        }
    }

    public function getEntreprises() {
        if (isset($_GET['p'])) {
            $page_actuelle = $_GET['p'];
        } else {
            $page_actuelle = 1;
        }
        $result = [];
        $entreprises = $this->connection->getAllRecords();
        $output = array_slice($entreprises, ($page_actuelle - 1)*10, 10);
        return $output;
    }

    public function getNbEntreprises(){
        return count($this->connection->getAllRecords());
    }

    public function getPageActuelle(){
        if (isset($_GET['p'])) {
            return $_GET['p'];
        } else {
            return 1;
        }
    }
}