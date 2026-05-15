<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='style.css' rel='stylesheet'>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BCGD1KMSQD"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
       gtag('js', new Date());

       gtag('config', 'G-BCGD1KMSQD');
    </script>
    <title>inauguration closambre</title>
</head>
<script>
        function toggleAccompagnateur() {
            var accompagnateurField = document.getElementById('blockaccompagnateur');
            var ouiRadio = document.getElementById('acc_oui');

            if (ouiRadio.checked) {
                accompagnateurField.style.display = 'flex';
            } else {
                accompagnateurField.style.display = 'none';
            }
        }
    </script>
<body>
    <img  class="imgtop" src="formegeogauche.png">
    <img  class="imgtop2" src="imageinvite2.webp">
    
    <?php include_once 'RecuperationFormulaire.php'; ?>
    <?php 
    /* formulaire */
    if(!isset($envoie)){ ?>
        
        <div class="responsivedroite"></div>
        <div class="responsivegauche"></div>
    
        <div class='Contact'>
            <div class="TitreForm">
                
                <img class='logo' src='logo-closambre.webp'>
                <p><strong> Inauguration et 30 ans de Closambre</strong> <br>
                <strong>Date :</strong> le 12 juillet 2024 <br>
                <strong>Lieu :</strong> (lieu non affiché) </p>
            </div>
            <form method='post'>
                <p><strong>Vos informations :</strong></p>
                <!-- Genre -->
                <label for='Genre'>Genre :</label>
                <select name="genre" class="form-select" aria-label="Default select example">
                    <option value="Madame">Madame</option>
                    <option value="Monsieur">Monsieur</option>
                    <option value="Autres">Autres</option>
                </select>

                <!-- Nom -->
                <label for='nom'>Nom* :</label><input class="form-control" id='nom' name='nom' type='text' value=<?php echo RecuperationValSaisie('nom'); ?>></input>
                <?php if (isset($erreurs['nom']) && !empty($erreurs['nom'])){
                    echo "<p class='erreur'>".$erreurs['nom'][0]."</p>";
                } ?>
                
                <!-- Prenom -->
                <label for='prenom'>Prénom* :</label><input  class="form-control" id='prenom' name='prenom' type='text' value=<?php echo RecuperationValSaisie('prenom'); ?>></input>
                <?php if (isset($erreurs['prenom']) && !empty($erreurs['prenom'])){
                    echo "<p class='erreur'>".$erreurs['prenom'][0]."</p>";
                } ?>
                
                <!-- Adresse -->
                <label for='adresse'>Adresse :</label><input  class="form-control"id='adresse' name='adresse' type='text' value=<?php echo RecuperationValSaisie('adresse'); ?>></input>
                
                <!-- Code postale et Ville -->
                <div class="englobevillecdp">
                    <div class="separationvillecdp">
                        <label for='codepostale'>Code Postal :</label><input  class="form-control" id='codepostale' name='codepostale' type='text' value=<?php echo RecuperationValSaisie('codepostale'); ?>></input>
                    </div>
                    <div class="separationvillecdp">
                        <label for='ville'>Ville :</label><input  class="form-control" id='ville' name='ville' type='text' value=<?php echo RecuperationValSaisie('ville'); ?>></input>
                    </div>
                </div>
                <?php if (isset($erreurs['codepostale']) && !empty($erreurs['codepostale'])){
                    echo "<p class='erreur'>".$erreurs['codepostale'][0]."</p>";
                } ?>

                <!-- Téléphone -->
                <label for='telephone'>Téléphone :</label><input  class="form-control" id='telephone' name='telephone' type='text' value=<?php echo RecuperationValSaisie('telephone'); ?>></input>
                <?php if (isset($erreurs['telephone']) && !empty($erreurs['telephone'])){
                    echo "<p class='erreur'>".$erreurs['telephone'][0]."</p>";
                } ?>

                <!-- Email -->
                <label for='email'>Email* :</label><input  class="form-control" id='email' name='email' type='text' value=<?php echo RecuperationValSaisie('email'); ?>></input>
                <?php if (isset($erreurs['email']) && !empty($erreurs['email'])){
                    echo "<p class='erreur'>".$erreurs['email'][0]."</p>";
                } ?>

                <!-- Organisation/Entreprise -->
                <label for='orga_entrep'>Organisation/Entreprise* :</label><input  class="form-control" id='orga_entrep' name='orga_entrep' type='text' value=<?php echo RecuperationValSaisie('orga_entrep'); ?>></input>
                <?php if (isset($erreurs['orga_entrep']) && !empty($erreurs['orga_entrep'])){
                    echo "<p class='erreur'>".$erreurs['orga_entrep'][0]."</p>";
                } ?>
            
            <!-- Fonction -->
                <label for='fonction'>Fonction* :</label><input  class="form-control" id='fonction' name='fonction' type='text' value=<?php echo RecuperationValSaisie('fonction'); ?>></input>
                <?php if (isset($erreurs['fonction']) && !empty($erreurs['fonction'])){
                    echo "<p class='erreur'>".$erreurs['fonction'][0]."</p>";
                } ?>

                <!-- Présence -->
                <div>
                <p  for='presence'>Serez-vous présent(e)* ?</p>
                    <div class="form-check">
                        <input type="radio"  class="form-check-input" id="p_oui" name="presence" value="oui" <?php IsChecked("presence","oui") ?> />
                        <label  class="form-check-label" for="oui">Sera présent(e)</label>
                    </div>

                    <div class="form-check">
                        <input type="radio"  class="form-check-input" id="p_non" name="presence" value="non" <?php IsChecked("presence","non") ?>/>
                        <label  class="form-check-label" for="non">Ne pourra être présent(e)</label>
                        
                    </div>
                </div>
                <?php if (isset($erreurs['presence']) && !empty($erreurs['presence'])){
                    echo "<p class='erreur'>".$erreurs['presence'][0]."</p>";
                } ?>

                <!-- Accompagné -->
                <div >
                    <p  for='presence'>Serez-vous accompagné(e) ?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="acc_oui" name="accompagnement" onclick="toggleAccompagnateur()" value="oui" <?php IsChecked("accompagnement","oui") ?> />
                        <label class="form-check-label" for="oui">Oui</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="acc_non" name="accompagnement" onclick="toggleAccompagnateur()" value="non" <?php IsChecked("accompagnement","non") ?>/>
                        <label class="form-check-label" for="non">Non</label>
                    </div>
                </div>
                <?php if (isset($erreurs['accompagnement']) && !empty($erreurs['accompagnement'])){
                    echo "<p class='erreur'>".$erreurs['accompagnement'][0]."</p>";
                } ?>

                <!-- Nom accompagnateur si accompagné -->
                <div id="blockaccompagnateur" class="blockaccompagnateur">
                    <label for='accompagnateur'>Nom accompagnateur :</label><input class="form-control" name='accompagnateur' type='text' value=<?php echo RecuperationValSaisie('accompagnateur'); ?>></input>
                </div>
                <label for='infos'><strong>Autres Informations :</strong></label>
                <textarea class="form-control" id='infos' name='infos' type='text'placeholder="Besoin d'accessibilité d'assistance spécifique ou message destiné aux organisateurs" ><?php echo RecuperationValSaisie('infos'); ?></textarea>
                <button type="submit" class="btn btn-success">Envoyer</button>
            </form>
            

            <!-- Autres informations -->
            <div class='informationsup'>
                    <p> *A compléter obligatoirement</p>
                    <p>Pour toute question, veuillez contacter : <br><br>
                    Nom de l'organisateur : Closambre <br>
                    <img class="picto-mail" src="picto-mail.webp">  (mail non affichée) <br>
                    <img class="picto-tel" src="picto-tel.webp">  (numero non affiché) <br><br>
                </p>      
            </div>
        </div>
        <?php } 
        else{
            echo '<div class="Contact">';
            echo '<img class="logo" src="logo-closambre.webp">';
            echo '<h1 class="confirmation"> Merci pour votre inscription <br> A bientôt</h1>';
            echo '</div>';
        }
        ?>
    <div class='footerinvisible'></div>
    <div class='footer'>
        <p> Tous droits reservés | Closambre &copy</p>
    </div>
</body>
</html>