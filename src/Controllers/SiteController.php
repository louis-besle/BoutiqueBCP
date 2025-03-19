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
        $articles = $this->model->getArticles();
        echo $this->templateEngine->render('accueil.twig.html', ['articles' => $articles]);
    }

    public function pageContact() {
        echo $this->templateEngine->render('contact.twig.html');
    }
}
