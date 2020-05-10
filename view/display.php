<?php


//*************************************************************************
//fonction d'affichage de la nav bar

function displayNavBar(){
    ?>
    <div id="NavBar">
    <nav>
        <ul>
    <?php if(isset($_SESSION["id"])){
        echo ("<li>Bonjour ".$_SESSION["prenom"]."</li>"); ?>
        <li><div id="fonctionnalité">

                <form method="post" action="index.php?page=addEvent">
                    <p>
                        <input type="submit" value="Ajouter un évenement" id="bouton">
                    </p>
                </form>

        </div></li>
        <li>
            <form method="post" action="index.php?page=addGroupe">
                <p>
                    <input type="submit" value="ajouter un groupe" id="bouton"/>
                </p>
            </form>
        </li>
        <li><form method="post" action="index.php?page=deconnexion">
            <p>
                <input type='submit' value='deconnexion' id='bouton'/>
            </p>
        </form>
        </li>
    <?php } else {  ?>
       <li><form method="post" action="index.php?page=inscription">

            <p>
                <input type='submit' value='Inscription' id='bouton'/>
            </p>

        </form>
       </li>
        <li>
        <form method="post" action="index.php?page=connexion">
            <p>
                <input type='submit' value='connexion' id='bouton'/>
            </p>
        </form>
        </li>

    <?php } ?>
        </ul>
    </nav>
</div>
<?php }


//*************************************************************************
//Fonction d'affichage du formulaire pour ajouter un nouvel évenement
function displayEventajoute($tabGroupe)
{
    ?>
    <div class="event">
        <article>
            <form method="post" action="index.php">
                <p>
                    <label for ="groupe">Groupe:</label>
                    <select name="groupe">
                        <?php
                        foreach($tabGroupe as $value){
                            echo"<option value='".$value["id_groupe"]."'>".$value["nomgroupe"]."</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="debut" type="datetime-local" required>Début:</label>
                    <input name="debut" type="datetime-local" required>

                </p>
                <p>
                    <label for="fin" type="time" required>Fin:</label>
                    <input name="fin" type="time" required>

                </p>
                <p>
                    <label for="description"> Description : </label>
                    <textarea name="description" ></textarea>
                </p>
                <p>
                    <input name='action' type='hidden' value='addEvent'/>
                </p>
                <p>
                    <label for='add'></label>
                    <input type='submit' value='Ajouter' id='bouton'/>
                </p>
            </form>
        </article>
    </div>

    <?php
}

//*************************************************************************
//Fonction d'affiche du formulaire de connexion

function displayConnexion(){
    ?>
    <div class="inscription">
        <article>
            <form method='post' action='index.php'>
                <center>
                    <p>
                        <label for='mail'>E-mail</label>
                        <input name='mail' type='text' required>
                    </p>
                    <p>
                        <label for='mdp'>Mot de Passe</label>
                        <input name='mdp' type='password' required>
                    </p>
                    <p>
                        <input name='action' type='hidden' value='connexion'/>
                    </p>
                    <p>
                        <label for='add'></label>
                        <input type='submit' value='Connexion' id='bouton'/>
                    </p>
                </center>

            </form>
        </article>
    </div>
    <?php
}

//*************************************************************************
//fonction d'affichage du formulaire d'inscription
function displayInscription(){
    ?>
    <div class="inscription">
        <article>
            <form method='post' action='index.php'>
                <center>
                    <p>
                        <label for='firstname'>Nom</label>
                        <input name='firstname' type='text' required>
                    </p>
                    <p>
                        <label for='lastname'>Prenom</label>
                        <input name='lastname' type='text' required >
                    </p>
                    <p>
                        <label for='mail'>E-Mail</label>
                        <input name='mail' type='text' required >
                    </p>
                    <p>
                        <label for='mdp'>Mot de Passe</label>
                        <input name='mdp' type='password' requiered>
                    </p>
                    <p>
                        <input name='action' type='hidden' value='inscription'/>
                    </p>
                    <p>
                        <label for='add'></label>
                        <input type='submit' value='Inscription' id='bouton'/>
                    </p>
                </center>

            </form>
        </article>
    </div>
    <?php
}

//*************************************************************************
//fonction d'affichage de l'acceuil c'est à dire quand on arrive sur le site sans être connecté
function displayAcceuil(){
    ?>
<article>
    <h1>Vous devez être connecté pour voir votre agenda ! </h1>
    <div id ="Accueil">
      <ul><li>
            <form method="post" action="index.php?page=inscription">

        <p>
            <input type='submit' value='Inscription' id='bouton'/>
        </p>

        </form>
        </li>
        <li>
    <form method="post" action="index.php?page=connexion">
        <p>
            <input type='submit' value='connexion' id='bouton'/>
        </p>
    </form>
        </li>
      </ul>
    </div>
</article>
        <?php }


//*************************************************************************
//fonction d'affichage du calendrier
function displayCalendar($year,$date,$id){
            $events = $date -> getEvents($year,$id);
            $dates = $date -> getAll($year);
?>
            <div class="periods">
        <!-- Affiche l'année en haut -->
        <center>
        <div class="year">
            <?php echo $year; ?>
        </div>
        </center>
        <!--affiche le tableau des mois-->
        <div class="months">
            <ul>
                <?php foreach ($date->months as $id=>$m): ?>
                    <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,4)); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <?php $dates = current($dates); ?>
        <?php foreach ($dates as $m=>$days): ?>
            <div class="month relative" id="month<?php echo $m; ?>">
                <table>
                    <thead>
                    <tr>
                        <?php foreach ($date->days as $d): ?>
                            <th><?php echo substr($d,0,3); ?></th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $end = end($days); foreach($days as $d=>$w): ?>
                        <?php $time = strtotime("$year-$m-$d"); ?>
                        <?php if($d == 1 && $w != 1): ?>
                            <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                        <?php endif; ?>
                        <td<?php if($time == strtotime(date('Y-m-d'))): ?> class="today" <?php endif; ?>>
                            <div class="relative">
                                <div class="day"><?php echo $d; ?></div>
                            </div>
                            <div class="daytitle">
                                <?php echo $date->days[$w-1]; ?> <?php echo $d; ?>  <?php echo $date->months[$m-1]; ?>
                            </div>
                            <ul class="events">
                                <?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
                                    <li><?php echo $e; ?></li>
                                <?php endforeach; endif;  ?>
                            </ul>
                        </td>
                        <?php if($w == 7): ?>
                    </tr><tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($end != 7): ?>
                            <td colspan="<?php echo 7-$end; ?>" class="padding"></td>
                        <?php endif; ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="clear"></div>

<?php
        }



//*************************************************************************
//formulaire pour ajouter un groupe
function displayAddGroupe(){ ?>

        <article>
            <form method='post' action='index.php'>
                <center>
                    <p>
                        <label for='nomGroupe'>Nom du groupe</label>
                        <input name=nomGroupe type='text' required>
                    </p>
                    <p>
                        <label for='description'>description du groupe</label>
                        <input name='description' type='text' required >
                    </p>

                        <input name='action' type='hidden' value='addGroupe'/>
                    </p>
                    <p>
                        <label for='add'></label>
                        <input type='submit' value='Ajouter' id='bouton'/>
                    </p>
                </center>

            </form>
        </article>

    <?php
}