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


?>



<body>

	<h1> Ajoutez une ville </h1>

	<form method="POST" action="pays.php?id=<?php echo $id; ?>"> 




 		<br><input type="hidden" name="id" value= "<?php $id; ?>" ><br />

 		<br><label for="nom"> Ville: </label><input type="text" name="nom" ><br />

 		<br><label for="pop"> Population: </label><input type="number" name="pop" > <br/>




		<input type="submit" name="Ajout" value="Ajout" id="ajout">


	</form>

</body>


  </div>
 </div><!-- /.container -->


 <?php require_once 'footer.php'; ?>


</html>