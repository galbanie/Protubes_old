<h1 class="titreSectionMembre">Profile</h1>

<div id="divProfileMembre">

    <div id="imageMembreProfile">
        <img id="imageProfil" src="<?php if($_SESSION['membre']->getIdImage() !== null) echo 'Image.php?id='.$_SESSION['membre']->getIdImage();else echo 'Ressources/Images/Profil_default.jpg';?>" />
    </div>

    <div id="informationProfileMembre">
        <div>
            <span id="infoNomPrenom"><?=$_SESSION['membre']->getPrenom().' '.$_SESSION['membre']->getNom();?></span>
            <span id="infoAge">Age</span>

            <hr class="clearfloatBoth" />
            <span id="infoId"><?=$_SESSION['membre']->getIdentifiant();?></span>
            <span id="infoVille"><?=$_SESSION['membre']->getPays();?></span>
        </div>

        <div>
            <div>
                <div class="boxInfoDiv" >
                    <span class="spanHaut">video</span>
                    <span class="spanBas" >77</span>   
                </div>
                <!--span id="infoNbrVideo">77</span>
                <span id="infoNbrVideoLabel">videos</span-->
            </div>

            <div>
                <div class="boxInfoDiv" >
                    <span class="spanHaut">vue</span>
                    <span class="spanBas" >1 789 254</span>   
                </div>
                <!--span id="infoNbrVue">1 789 254</span>
                <span id="infoNbrVueLabel">vues</span-->
            </div>

        </div>
        <input type="button" id="membreProfileBtnModif" class="button" value="Modifier vos informations" onclick="document.location.href = '?page=membre&action=profile&modif=profile';" />
    </div>

    <div id="divProfileMembreAbonner">
        <div id="profileMembreAbonnement">
            
        </div>
        
        <div id="profileMembreAbonner">
            
        </div>
    </div>
    <hr class="clearfloatBoth" />
</div>