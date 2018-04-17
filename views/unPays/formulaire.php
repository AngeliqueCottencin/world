<html>

<?php require_once 'header.php'; ?>



<?php

  require_once('inc/manager-db.php');

  session_start ();

  if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
    echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']."(".$_SESSION['role'].")";
    echo '<br><a href="./logout.php">Deconnexion</a></p>';
    } 
  else
     header ('location: authentification.php');

?>


<div class="container">
  
  <div style='text-align:center'>



    <?php
     require_once('inc/connect-db.php');
     require_once('inc/manager-db.php');

     $id=$_GET['id'];



      $pays=getCountry($id);
      //$pays = Countries($_GET['continent']);

      foreach($pays as $valeur){
        
      	$nom = $valeur->Name;
        $surface = $valeur->SurfaceArea;
      	$habitant = $valeur->Population;
        $esperance = $valeur->LifeExpectancy;
        $pib = $valeur->GNP;
        $gouv = $valeur->GovernmentForm;
        $tete = $valeur->HeadOfState;
      	
      }
    ?>

    <body>

      <h2> Modifiez les informations du pays </h2>
      
      <form method="POST" action="pays.php?id=<?php echo $id; ?>"> 


        <br><input type="hidden" name="id" value= "<?php $pays->id; ?>" ><br />

        <br> <label for=""> Nom du pays: </label> <input type="text" name="nom" value= "<?php echo $nom; ?>"  ><br />

        <br> <label for=""> Surface: </label> <input type="number" name="surface" value= "<?php echo $surface; ?>"> <br/>

        <br> <label for=""> Population: </label> <input type="text" name="habitant" value= "<?php echo $habitant; ?>" ><br />

        <br> <label for=""> Espérance de vie: </label> <input type="number" name="esperance" value= "<?php echo $esperance ?>"> <br />


        <br> <label for=""> PIB : </label> <input type="number" name="pib" value="<?php echo $pib ?>"><br>

        <br> <label for=""> Forme de l'Etat: </label> <input type="text" name="gouv" value="<?php echo $gouv?>"></br>

        <br> <label for=""> Tête du pays: </label> <input type="text" name="tete" value="<?php echo $tete ?>"></br>



        <input type="submit" name="Modifier" value="Modifier" id="update">


       </form>

     </body>


   </div>

</div><!-- /.container -->

<?php require_once 'footer.php'; ?>

</html>