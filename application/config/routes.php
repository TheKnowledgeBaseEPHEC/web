<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['apropos'] = 'about';

$route['inscription'] = 'Inscription';

$route['activation/(:any)'] = 'Inscription/verify/$1';

// helper pour l'application mobile
$route['sendmail/(:any)'] = 'Inscription/sendmail/$1';

$route['connexion'] = 'Login';
$route['deconnexion'] = 'Login/logout';
$route['profil'] = 'Profil';
$route['profil/(:any)'] = 'Profil/view/$1';
$route['profil/data'] = 'Profil/data';
$route['profil/seancesterminees'] = 'Profil/mes_seances_termines';
$route['editionprofil'] = 'Profil/edit_profile';
$route['mdpoublie'] = 'Profil/mdp_oublie';
$route['upload'] = "Profil/do_upload";
$route['confirmAide'] = 'ConfirmAide';
$route['confirmAide/(:any)'] = 'ConfirmAide/view/$1';
$route['confirmDemande'] = 'ConfirmDemande';
$route['confirmDemande/(:any)'] = 'ConfirmDemande/view/$1';
$route['ajouter_cour'] = 'Fac/ajouter_cour';
$route['submit'] = 'Inscription/registration';

$route['thanks_user'] = 'Thanks_user/index';

$route['fac'] = 'Fac';
$route['fac/(:any)'] = 'Fac/view/$1';
$route['facdata'] = 'Fac/get';
$route['cours'] = 'Fac/cours';
$route['ajouter_cour'] = 'Fac/ajouter_cour';
$route['cours/(:any)'] = 'Fac/cours/$1';

$route['rating'] = 'Rating';
$route['contact'] = 'contact';

$route['data'] = 'Home/data';

$route['default_controller'] = 'home';

$route['404_override'] = 'Errors/page_404';