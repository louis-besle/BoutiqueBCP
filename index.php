<?php
/**
 * This is the router, the main entry point of the application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

require "vendor/autoload.php";

use App\Controllers\SiteController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
} else {
    $uri = '/';
}

$controller = new SiteController($twig);

switch ($uri) {
    case '/':
        $controller->pageAccueil();
        break;
    case 'entreprise':
        $controller->pageEntreprise();
        break;
    case 'offres' : 
        $controller->pageOffres();
        break;
    case 'offre' :
        $controller->pageOffre();
        break;
    case 'wishlist' :
        $controller->pageWishlist();
        break;
    case 'contact' :
        $controller->pageContact();
        break;
    default:
        // TODO : return a 404 error
        echo '404 Not Found';
        break;
}
?>