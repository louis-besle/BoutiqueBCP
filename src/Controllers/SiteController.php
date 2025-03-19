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

    public function pageEntreprise() {
        $entreprises = $this->model->getEntreprises();
        $nbentreprise = $this->model->getNbEntreprises();
        $page_actuelle = $this->model->getPageActuelle();
        echo $this->templateEngine->render('entreprise.twig.html', ['entreprises' => $entreprises,'page_actuelle' => $page_actuelle, 'nb_entreprises' => $nbentreprise]);
    }

    public function pageOffres() {
        echo $this->templateEngine->render('offres.twig.html');
    }

    public function pageOffre() {
        echo $this->templateEngine->render('offre.twig.html');
    }

    public function pageWishlist() {
        echo $this->templateEngine->render('wishlist.twig.html');
    }

    public function pageContact() {
        echo $this->templateEngine->render('contact.twig.html');
    }
}
