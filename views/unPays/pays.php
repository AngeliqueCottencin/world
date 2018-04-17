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



<?php require_once 'header.php'; ?>
<div class="container">
  
  <div style='text-align:center'>





   <?php
 	  require_once('inc/connect-db.php');
    require_once('inc/manager-db.php');



    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $tabpays = getCountry($id);
      $langue = getLanguage($id);
      $ville = getVilles($id);
    
      
    }
    


    if(isset($_POST['Modifier'])){
      getUpdate($_GET['id']);
    }



    if(isset($_POST['Ajout'])){
      ajoutVille($_GET['id'], $_POST['nom'], $_POST['pop']);


    }
      ?>
    






  <h1 align="center"> <font color="#0131B4"> Informations supplémentaires </h1>
&nbsp
&nbsp
&nbsp



  <!-- tableau pour les langues -->

 <table  border = 1 table = "table" class="table table-hower">

 

	
  <tr>

   <th> <font size=4 color="#6495ED"> Langues Parlées</th> 
  
   <th> <font size=4 color="#6495ED"> Pourcentage</th> 

  </tr> 


  <?php foreach($langue as $language): ?>

  <tr>

    <td><?php echo $language->Name; ?></td>

    <td><?php echo $language->Percentage; ?></td>

  </tr>

  <?php endforeach ?>
  </table>






<!-- tableau pour afficher les villes -->


<table border=1 table="table" class="table table-hower">


<?php foreach( $tabpays as $pays ): ?>


<tr>

  <th> <font size=4 color="#6495ED"> Ville  <?php if ($_SESSION['role'] == "admin"): ?>  &nbsp &nbsp <a href='ajoutVille.php?id=<?php echo $pays->id; ?>'> <font color="#5472AE">Ajouter une ville </a>  <?php endif; ?> </th>

  <th> <font size=4 color="#6495ED"> Population</th> 

</tr>


  <?php endforeach ?>



  <?php foreach($ville as $vivi): ?>


   <tr>


    <td><?php echo $vivi->Name ?></td>

    <td><?php echo $vivi->Population ?></td>


   </tr>

  <?php endforeach ?>

 </table>







<!-- tableau pour afficher les données du pays -->
 <table border = 1 table="table" class="table table-hower" >


  
  <?php foreach($tabpays as $pays): ?>
    <tr>

      <th> <font size=4 color="#6495ED"> Pays <?php if ($_SESSION['role'] == "admin"): ?> &nbsp &nbsp  <a href='formulaire.php?id=<?php echo $pays->id; ?>'> <font color="#5472AE">Modifier </a> <?php endif; ?> </th>

    </tr>



    <tr>
      <td>Id: <?php echo $pays->id ?></td>
    </tr>

    <tr>
      <td>Nom: <?php echo $pays->Name ?></td>
    </tr>

    <tr>
      <td>Continent: <?php echo $pays->Continent ?></td>
    </tr>

    <tr>
      <td>Région: <?php echo $pays->Region ?></td>
    </tr>

    <tr>
      <td>Superficie: <?php echo $pays->SurfaceArea?></td>
    </tr>

    <tr>
      <td>Année d'indépendance: <?php echo $pays->IndepYear ?></td>
    </tr>

    <tr>
      <td>Population: <?php echo $pays->Population ?></td>
    </tr>

    <tr>
      <td>Espérance de vie: <?php echo $pays->LifeExpectancy ?></td>
    </tr>

    <tr>
      <td>PIB: <?php echo $pays->GNP ?> </td>
    </tr>

    <tr>
      <td>Forme de l'Etat: <?php echo $pays->GovernmentForm?> </td>
    </tr>

    <tr>
      <td>Tête du pays: <?php echo $pays->HeadOfState ?> </td>
    </tr>

    <tr>
      <td>Capitale: <?php echo getCapitale($pays->Capital);?> </td>
    </tr>

    <tr>
      <td>Nombre de villes: <?php echo getNbVille($pays->id); ?> </td>
    </tr>


  
  <?php endforeach ?>
 </table>







  </div>
</div><!-- /.container -->
<?php require_once('footer.php'); ?>