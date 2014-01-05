<h1 class="titreSectionMembre">Gestionnaire</h1>
<!--div class="membreGestionCate">
    <div class="membreGestionCateTitre" onclick="showHideElementBlock('mesSeries');">
        <h3>Mes Series</h3>
    </div>
    <div id="mesSeries" class="membreGestionCateContent" style="display: none;"></div>
</div>
<div class="membreGestionCate">
    <div class="membreGestionCateTitre" onclick="showHideElementBlock('mesVideos');">
        <h3><!--?=$langTexte['membreGestionMesVideos'] ?></h3>
    </div>
    <div id="mesVideos" class="membreGestionCateContent" style="display: none;"></div>
</div>
<div class="membreGestionCate">
    <div class="membreGestionCateTitre" onclick="showHideElementBlock('mesFavories');">
        <h3>Mes Favories</h3>
    </div>
    <div id="mesFavories" class="membreGestionCateContent" style="display: none;"></div>
</div-->
  <div id="gestion-tabs">
      <ul>
        <li><a href="#tab-videos">Mes vidéos</a></li>
        <li><a href="#tab-series">Mes séries</a></li>
        <li><a href="#tab-images">Mes images</a></li>
        <li><a href="#tab-documents">Mes documents</a></li>
        <li><a href="#tab-favories">Mes Favories</a></li>
      </ul>
      <div id="tab-videos">
          <div class="menu-gestion-tabs">
                <button class="btn-menu-gestion-tabs" type="button" value="addSerie">Affecter à une série</button>
                <button class="btn-menu-gestion-tabs" type="button" value="delete">Supprimer</button>
            </div>
          
            <table id="content-gestion-video">
                <tr>
                    <td>
                        <input class="checkbox-vue-block" type="checkbox" />
                        <a id="v-1" href="#" class="vue-block vue-block-video" style="background: url('Ressources/Images/icone_video.png') no-repeat center #cccccc;">
                            
                        </a>
                    </td>
                    <td>
                        <input class="checkbox-vue-block" type="checkbox" />
                        <a href="#" class="vue-block vue-block-video" style="background: url('Ressources/Images/icone_video.png') no-repeat center #cccccc;">
                            
                        </a>
                    </td>
                    <td>
                        <input class="checkbox-vue-block" type="checkbox" />
                        <a href="#" class="vue-block vue-block-video" style="background: url('Ressources/Images/icone_video.png') no-repeat center #cccccc;">
                            
                        </a>
                    </td>
                    <td>
                        <input class="checkbox-vue-block" type="checkbox" />
                        <a href="#" class="vue-block vue-block-video" style="background: url('Ressources/Images/icone_video.png') no-repeat center #cccccc;">
                            
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                    <td>
                        <a href="#" class="vue-block vue-block-video">
                            
                        </a>
                    </td>
                </tr>
            </table>
      </div>
      <div id="tab-series">

      </div>
      <div id="tab-images">

      </div>
      <div id="tab-documents">

      </div>
      <div id="tab-favories">

      </div>
      
</div>