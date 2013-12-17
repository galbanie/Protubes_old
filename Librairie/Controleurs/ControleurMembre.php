<?php

/**
 * Description of ControleurMembre
 *
 * @author galbanie
 */
class ControleurMembre extends Controleur{
    
    private $membreManager;
    private $compteManager;
    
    public function __construct() {
        $this->membreManager = new MembreManager(DataBase::instancie());
        $this->compteManager = new CompteManager(DataBase::instancie());
    }
    
    public function executerAction(){
        try{
            $this->alternerFormulaire();
            if(isset($_SESSION['membre']) && isset($_SESSION['compte']) && $_SESSION['compte']->isActif()){
                
                if(isset($_GET['action'])){
                    switch ($_GET['action']) {
                        case "profile":
                            if(isset($_REQUEST['modif']) && $_REQUEST['modif'] == 'profile'){
                                Donnees::ajouterValeur('membreModifProfile.php','panelMembreContent');
                            }
                            else{
                                Donnees::ajouterValeur('membreProfile.php','panelMembreContent');
                            }
                            $this->actualiserDonnees();
                        break;
                        case "alerte":
                            Donnees::ajouterValeur('membreAlerte.php','panelMembreContent');
                        break;
                        case "gestionnaire":
                            Donnees::ajouterValeur('membreGestion.php','panelMembreContent');
                        break;
                        case "settings":
                            if(isset($_REQUEST['form']) && $_REQUEST['form'] == 'reglage'){
                                
                            }
                            
                            $this->actualisationVueReglage();
                            
                            $this->actualiserDonnees();
                            
                            Donnees::ajouterValeur('membreReglage.php','panelMembreContent');
                        break;
                        case "deconnexion":
                            unset($_SESSION['membre']);
                            unset($_SESSION['compte']);
                            header("Location: ?page=membre");
                            exit();
                        break;
                        default:
                            Donnees::ajouterValeur('infoBarMembre.php','infoBarMembre');
                            Donnees::ajouterValeur('membreGeneral.php','panelMembreContent');
                        break;
                    }
                }
                else {
                    Donnees::ajouterValeur('infoBarMembre.php','infoBarMembre');
                    Donnees::ajouterValeur('membreGeneral.php','panelMembreContent');
                }
            }
            else{
                if(isset($_REQUEST['reauth'])){
                    if(isset($_SESSION['membre'])){
                        if($_SESSION['membre']->getId() == Crypteur::getCrypteur()->decode($_REQUEST['reauth'])){
                            if($this->envoieMailInscription($_SESSION['membre'])) Donnees::ajouterValeur('validerInscription','etat');
                            else Donnees::ajouterValeur('erreurEnvoieMail','etat');
                        }
                    }
                    else{
                        
                    }
                }
                if(isset($_POST['connexion'])){
                    if(!empty($_POST['connexion']['email']) && !empty($_POST['connexion']['password'])){
                        if(filter_var($_POST['connexion']['email'], FILTER_VALIDATE_EMAIL)){
                            $membre = $this->effectuerConnexion();
                            if ($membre){
                                $compte = $this->compteManager->get('idMembre', $membre->getId());
                                if($compte){
                                    $_SESSION['membre'] = $membre;
                                    //$_SESSION['membre']->attach($this->membreManager);
                                    $_SESSION['compte'] = $compte;
                                    //$_SESSION['compte']->attach($this->compteManager);
                                    if(!$_SESSION['compte']->isActif()){
                                        Donnees::ajouterValeur('inscriptionInvalide','etat');
                                        // on recupère l'url racine du site dans les configs
                                        $urls = Config::getConfig('url');
                                        // on génère le lien de validation à partir de l'url
                                        $lienReConfirm = $urls['local'].'/?page=membre&reauth='.Crypteur::getCrypteur()->code($_SESSION['membre']->getId());
                                        Donnees::ajouterValeur($lienReConfirm, 'lienReConf');
                                    }
                                    else{
                                        header("Location: ?page=membre");
                                        exit();
                                    }
                                } 
                            }
                            else{
                                //message pour avertir que le mot de passe est incorrecte
                            }
                        }
                        else{
                            //message pour avertir d'un email non valide
                        }
                    }
                }
                if(isset($_POST['inscription'])){
                    if($this->verifierMembreExiste() === 0){
                        $newMembre = new Membre();
                        $newMembre->setNom($_POST['inscription']['nom']);
                        $newMembre->setPrenom($_POST['inscription']['prenom']);
                        $newMembre->setDateNaissance($_POST['inscription']['dateNaissance']);
                        $now = new DateTime('NOW');
                        $newMembre->setDateInscription($now->format('Y-m-d'));
                        $newMembre->setEmail($_POST['inscription']['email']);
                        $newMembre->setIdentifiant($_POST['inscription']['identifiant']);
                        $newMembre->setPassword(Crypteur::getCrypteur()->code($_POST['inscription']['password']));

                        $idNewMembre = $this->membreManager->add($newMembre);
                        if($idNewMembre || $idNewMembre != 0){
                            $newMembre->setId($idNewMembre);
                            $compteMembre = new Compte();
                            $compteMembre->setIdMembre($idNewMembre);
                            $idCompte = $this->compteManager->add($compteMembre);
                            if($idCompte || $idCompte != 0){
                                if($this->envoieMailInscription($newMembre)) Donnees::ajouterValeur('validerInscription','etat');
                                else Donnees::ajouterValeur('erreurEnvoieMail','etat');

                            }
                        }
                    }
                    unset($_POST['inscription']);    
                }
                if(isset($_REQUEST['auth'])){
                    $compteMembre = $this->compteManager->get('idMembre', Crypteur::getCrypteur()->decode($_REQUEST['auth']));
                    if($compteMembre) {
                        // On attache le compteManager comme Observeur du compteMembre
                        $compteMembre->attach($this->compteManager);
                        // On set l'attribut actif à vrai et on notify les observeurs
                        $compteMembre->setActif(true, true);
                        Donnees::ajouterValeur('inscriptionValide','etat');
                    }
                    else Donnees::ajouterValeur('erreurValidation','etat');
                }
            }
            $this->affecterMessage();
            $this->genererVue('vueMembre');
        } catch(Exception $e){
            echo $e->getMessage();
            $this->genererVue('vueError');
        }
    }
    
    protected function alternerFormulaire(){
        if (!isset($_SESSION['form'])){
            $_SESSION['form'] = "Connexion";
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['formulaire'])){
                $_SESSION['form'] = $_POST['formulaire'];
                unset($_POST['formulaire']);
            }
        }
        Donnees::ajouterValeur($_SESSION['form'],'formulaire');
    }
    
    protected function affecterMessage(){
        if(!Donnees::existeKey('messages')){
            Donnees::ajouterValeur(array('formulaire' => 'Inscription'),'messages');
            //$this->donnees['messages']['formulaire'] = "Inscription";
        }
        if(Donnees::existeValeur('formulaire', 'Inscription')){
            Donnees::ajouterValeur(array('formulaire' => 'Connexion'),'messages');
            //$this->donnees['messages']['formulaire'] = "Connexion";
        }
        else{
            Donnees::ajouterValeur(array('formulaire' => 'Inscription'),'messages');
            //$this->donnees['messages']['formulaire'] = "Inscription";
        }
        // Message provenant des requetes
        if (isset($_REQUEST['m'])){
             switch ($_REQUEST['m']) {
                case "upload":
                    Donnees::ajouterValeur(array_merge(Donnees::getValeur('messages'),array('noMembreUp' => 'NoMembreUp')),'messages');
                break;
            }
        }
    }
    
     protected function effectuerConnexion(){
        $membre = $this->membreManager->get("email",$_POST['connexion']['email']);
        if($membre){
            if($membre->getPassword() === Crypteur::getCrypteur()->code($_POST['connexion']['password'])){
                return $membre;
            }
            else Donnees::ajouterValeur("pwd error",'connectError');
        }
        else Donnees::ajouterValeur("email error",'connectError');
        return false;
    }
    
    protected function actualiserDonnees(){
        $_SESSION['membre'] = $this->membreManager->get('id', $_SESSION['membre']->getId());
        $_SESSION['compte'] = $this->compteManager->get('id', $_SESSION['compte']->getId());
    }
    
    protected function verifierMembreExiste(){
        if($this->membreManager->get("email",$_POST['inscription']['email'])) return 2;
        if($this->membreManager->get("identifiant",$_POST['inscription']['identifiant'])) return 1;
        return 0;//Si les informations saisis ne correspond a aucun membre.
    }
    
    protected function envoieMailInscription(Membre $membre){
        try{
            $mail = new PHPMailer(true);
            // on recupère l'url racine du site dans les configs
            $urls = Config::getConfig('url');
            // on génère le lien de validation à partir de l'url
            $lienConfirm = $urls['local'].'/?page=membre&auth='.Crypteur::getCrypteur()->code($membre->getId());
            // on recupère le template du mail html
            $message = file_get_contents(dirname(__FILE__).'/../../Ressources/Templates/Mails/mailConfirmIns.html');
            //on intègre les informations du membre dans le mail y compris le lien de validation
            $message = sprintf($message,$membre->getPrenom(),$membre->getNom(),$urls['local'],$lienConfirm);
            
            //$message =  eregi_replace('[\]', '', $message);
            $message = preg_replace("/[\\\\]/i", '', $message);
            
            $mail->SetFrom('admin@protubes.com', 'Administrateur');
            $mail->AddAddress($membre->getEmail(), $membre->getPrenom().' '.$membre->getNom());
            
            $mail->Subject = 'Finaliser votre inscription sur Protubes';
            
            $mail->MsgHTML($message);
            
            return $mail->Send();
        }catch(Exception $e){
            return false;
        }
        
    }
    
    protected function actualisationVueReglage(){
        // on selectionne la valeur newsletter du compte
        if($_SESSION['compte']->isNewsletter()){
            Donnees::ajouterValeur('checked','newsletterOui');
            Donnees::ajouterValeur('','newsletterNon');
        }
        else{
            Donnees::ajouterValeur('','newsletterOui');
            Donnees::ajouterValeur('checked','newsletterNon');
        }
        
        if($_SESSION['compte']->isPermettreRechercheMembre()){
            Donnees::ajouterValeur('checked','permettreOui');
            Donnees::ajouterValeur('','permettreNon');
        }
        else{
            Donnees::ajouterValeur('','permettreOui');
            Donnees::ajouterValeur('checked','permettreNon');
        }
        
        if($_SESSION['compte']->getLangueDefault() == 'fr'){
            Donnees::ajouterValeur('selected','langDefFr');
            Donnees::ajouterValeur('','langDefEn');
        }
        else if($_SESSION['compte']->getLangueDefault() == 'en'){
            Donnees::ajouterValeur('','langDefFr');
            Donnees::ajouterValeur('selected','langDefEn');
        }
        
        if($_SESSION['compte']->getConfidentialiteDefault() == 'public'){
            Donnees::ajouterValeur('selected','confiDefPublic');
            Donnees::ajouterValeur('','confiDefPrivate');
        }
        else if($_SESSION['compte']->getConfidentialiteDefault() == 'private'){
            Donnees::ajouterValeur('','confiDefPublic');
            Donnees::ajouterValeur('selected','confiDefPrivate');
        }
        
    }
    
}

?>
