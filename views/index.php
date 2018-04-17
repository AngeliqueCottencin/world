



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
  <div class="starter-template">
    <h1>World</h1>
    <p class="lead"> Vous trouverez sur ce site un tableau regroupant tous les pays du monde, ainsi qu'une carte du monde intéractive <br>Sélectionnez un pays sur la carte ou dans le tableau pour obtenir des informations supplémentaires<br></p>
    <!--<a href="http://getbootstrap.com/examples/starter-template/"> </a>-->
  </div>
  <div style='text-align:center'>

 <?php require_once('javascript/ammap/maps/svg/world.svg') ?>


   <?php
    require_once('inc/connect-db.php');
    require_once('inc/manager-db.php');

      
      if(isset($_GET['continent'])){
        $continent = $_GET['continent'];
        $tabPays = Countries($continent);
      }
      else{
      $tabPays = Countries();
  }
      
  if(isset($_POST['update'])){
      getUpdate($_POST);


  }

    ?>




    <table class='table'>

    <tr>
      <th> <font size=4 > Pays </th> 
      <th> <font size=4 > Nombre d'habitants </th> 
      <th> <font size=4 > Capitale </th>
      <th> <font size=4 > PIB </th> 
      <th> <font size=4 > Espérance de vie </th> 
      <th> <font size=4 > Nombre de villes </th></tr>
          
      <?php foreach( $tabPays as $pays ): ?>

    <tr>

      <td> <a href='pays.php?id=<?php echo $pays->id; ?>' > <font color="#5472AE"> <?php echo $pays->Name; ?> </a></td>

      <?php if($pays->Population == 0 ): ?>
        <td> <?php echo "Pas d'habitants"; ?> </td>

      <?php else: ?>
        <td> <?php echo $pays->Population; ?> </td>

      <?php endif; ?>



      <?php if(getCapitale($pays->id) == NULL): ?>
        <td> <?php echo "Non renseigné" ?></td>
  
      <?php else: ?>
        
        <td> <?php echo getCapitale($pays->id); ?> </td>
      
      <?php endif; ?>



      
      <?php if($pays->GNP == 0): ?>
        <td> <?php echo "Pas de PIB" ; ?> </td>

      <?php else: ?>
        <td> <?php echo $pays->GNP; ?> </td>

      <?php endif; ?>


      <?php if($pays->LifeExpectancy == 0): ?>
      <td> <?php echo "Pas d'espérance de vie " ?> </td>

      <?php else: ?>
      <td> <?php echo $pays->LifeExpectancy; ?> </td>

      <?php endif; ?>



      <?php if(getNbVille($pays->id)== 0): ?>
      <td> <?php echo "Pas de villes(s)"; ?> </td>

      <?php else: ?>
            <td> <?php echo getNbVille($pays->id); ?> </td>

      <?php endif; ?>
      





   </tr>

   <?php endforeach ?>

   </table>



  </div>
</div><!-- /.container -->
<?php require_once 'footer.php'; ?>
