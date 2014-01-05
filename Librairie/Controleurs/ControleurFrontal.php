<?php

/**
 * Description of ControleurFrontal
 *
 * @author galbanie
 */
class ControleurFrontal extends Controleur {
    
    public function __construct() {
        
    }
    
    public function routerRequete(){
        try{
            $this->definirLangue();
            $this->verifierUsager();
            $realpath = Config::getConfig('url');
            Donnees::ajouterValeur($realpath['local'], 'realpath');
            
            /*$page = (isset($_REQUEST['page'])? $_REQUEST['page'] : 'default');
            ControleurFactory::getControleur($page)->executerAction();*/
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
                ControleurFactory::getControleur($page)->executerAction();
            }
            else if (isset($_REQUEST['search_query'])){
                ControleurFactory::getControleur('search')->executerAction();
            }
            else if (isset($_REQUEST['watch'])) {
                ControleurFactory::getControleur('watch')->executerAction();
            }
            else if (isset($_REQUEST['entity'])) {
                ControleurFactory::getControleur('entity')->executerAction();
            }
            else ControleurFactory::getControleur()->executerAction();
        } catch (Exception $e){
            $this->genererVue('vueError');
        }
    }
    
    protected function definirLangue(){
        if (!isset($_SESSION['lang'])){
            $_SESSION['lang'] = Language::getLangueServer();
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['lang'])){
                $_SESSION['lang'] = $_POST['lang'];
                unset($_POST['lang']);
            }
        }
    }
    
    protected function verifierUsager(){
        if(isset($_SESSION['membre']) && isset($_SESSION['compte']) && $_SESSION['compte']->isActif()){
            
            Donnees::ajouterValeur('Sections/Modules/Membre/btnUsager.php', 'includeBtnUser');
            Donnees::ajouterValeur('Sections/Modules/Membre/zoneMembrePanel.php', 'includeSectionMembre');
            Donnees::ajouterValeur('Sections/Modules/Membre/sidebarGaucheMembre.php', 'includeSidebarGauche');
            if(isset($_SESSION['image']) && $_SESSION['image'] !== $_SESSION['membre']->getImage()) {
                $_SESSION['membre']->setImage($_SESSION['image']);
            }
        }
        else{
            Donnees::ajouterValeur('Sections/Modules/NonMembre/btnSignIn.php', 'includeBtnUser');
            Donnees::ajouterValeur('Sections/Modules/NonMembre/zoneNonMembre.php', 'includeSectionMembre');
            Donnees::ajouterValeur('Sections/Modules/NonMembre/sidebarGauche.php', 'includeSidebarGauche');
        }
    }
    
}

?>
