<h1 class="titreSectionMembre">Réglage</h1>
<form method="POST" action="">
    <input type="hidden" name="form" value="reglage" />
    <div id="informationReglage">
        <div class="divInputReglage backgroundDivDark">
            <label class="labelInfo">Recevoir nos newsletters</label>
            <div>
                <label><input type="radio" name="newsletter" value="Oui" <?=$newsletterOui ?> />Oui</label>
                <label><input type="radio" name="newsletter" value="Non" <?=$newsletterNon ?> />Non</label>
            </div>
            <hr class="clearfloatBoth" />
        </div>
        
        <div class="divInputReglage">
            <label class="labelInfo">Langue préférée</label>
            <div>
                <select>
                    <option <?=$langDefFr ?> >Français</option>
                    <option <?=$langDefEn ?> >Anglais</option>
                </select>
            </div>
            <hr class="clearfloatBoth" />
        </div>
        
        <div class="divInputReglage backgroundDivDark">
            <label class="labelInfo">Permettre aux autres membres de me retrouver</label>
            <div>
                <label><input type="radio" name="permission" value="Oui" <?=$permettreOui ?> />Oui</label>
                <label><input type="radio" name="permission" value="Non" <?=$permettreNon ?> />Non</label>
            </div>
            <hr class="clearfloatBoth" />
        </div>
        
        <div class="divInputReglage">
            <label class="labelInfo">Confidentialité par default</label>
            <div>
                <select>
                    <option <?=$confiDefPrivate ?> >Privée</option>
                    <option <?=$confiDefPublic ?> >Publique</option>
                </select>
            </div>
            <hr class="clearfloatBoth" />
        </div>
        
        <div id="confirmEditMembreReglage">
            <input id="btnSupprimerCompte" class="button" type="button" value="Supprimer votre compte" />
            <input type="reset" value="Annuler" />
            <input type="submit" value="Enregistrer les modifications" />
        </div>
        
    </div>
</form>