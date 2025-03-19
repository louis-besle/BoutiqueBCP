<?php 
namespace App\Controllers;

use App\Models\SiteModel;

class SiteController extends Controller {

    public function __construct($templateEngine) {
        $this->model = new SiteModel();
        $this->templateEngine = $templateEngine;
    }

    public function pageAccueil() {
        // TODO: Retrieve the list of tasks from the model
        echo $this->templateEngine->render('accueil.twig.html');
    }

    public function pageContact() {
        echo $this->templateEngine->render('contact.twig.html');
    }
}
