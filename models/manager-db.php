<?php
require_once('connect-db.php');

/** Obtenir la liste de tous les pays référencés d'un continent donné
    ou de la planète entière
*/
function Countries($continent = null) {
   // pour utilisater la variable globale dans la fonction
   global $pdo;
   if (!$continent) :
     $query = 'SELECT * FROM Country;';
     return $pdo->query($query)->fetchAll();
   else :
     $query = 'SELECT * FROM Country WHERE Continent = :continent;';
     $prep = $pdo->prepare($query);
     $prep->bindValue(':continent', $continent, PDO::PARAM_STR);
     $prep->execute();
     return $prep->fetchAll();
   endif;
}


function getCountry($id){
  global $pdo;

  $req='SELECT * FROM Country WHERE id=:id';
  $prep=$pdo->prepare($req);
  $prep->bindValue(':id', $id, PDO::PARAM_INT);
  $prep->execute();
  return $prep->fetchAll();
}

function getUpdate($id){
  global $pdo;

  $id = $_GET['id'];
  $nom = $_POST['nom'];
  $surface=$_POST['surface'];
  $habitant = $_POST['habitant'];
  $esperance = $_POST['esperance'];
  $pib = $_POST['pib'];
  $gouv = $_POST['gouv'];
  $tete = $_POST['tete'];
  
 /*$id = $params['id'];
  $nom = $params['nom'];
  $surface = $params['surface'];
  $habitant = $params['habitant'];
  $esperance = $params['esperance'];
  $pib = $params['pib'];
  $gouv = $params['gouv'];
  $tete = $params['tete'];
*/
 


  $req = "UPDATE Country SET Name=:nom, SurfaceArea=:surface, Population=:habitant, LifeExpectancy=:esperance, GNP=:pib, GovernmentForm=:gouv, HeadOfState=:tete WHERE id=:id;";

    $prep = $pdo->prepare($req);

    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
    $prep->bindValue(':surface', $surface, PDO::PARAM_INT);  
    $prep->bindValue(':habitant', $habitant, PDO::PARAM_INT);
    $prep->bindValue(':esperance', $esperance, PDO::PARAM_INT);
    $prep->bindValue(':pib', $pib, PDO::PARAM_INT);
    $prep->bindValue(':gouv', $gouv, PDO::PARAM_STR);
    $prep->bindValue(':tete', $tete, PDO::PARAM_STR);



    $prep->execute();
}


function getNomPays(){
  global $pdo;
  $query = 'SELECT Name FROM Country WHERE Continent = "Asia" ;';
  return $pdo->query($query)->fetch();
}



function getNbVille($id){
  global $pdo;
  $req = 'SELECT COUNT(*) as nb FROM City WHERE  idcountry = :id ; ';
  $prep = $pdo->prepare($req);
  $prep->bindValue(':id', $id, PDO::PARAM_INT);
  $prep->execute();
  return $prep -> fetch()->nb;
}

function getCapitale($id){
  global $pdo;
  $req = 'SELECT Name as capitale FROM City WHERE id=:id';
  $prep = $pdo->prepare($req);
  $prep->bindValue(':id', $id, PDO::PARAM_INT);
  $prep->execute();
  return $prep->fetch()->capitale;

}

function getLanguage($id){
global $pdo;

$req = 'SELECT Language.Name, CountryLanguage.Percentage FROM CountryLanguage, Language WHERE  CountryLanguage.idLanguage = Language.id AND idCountry = :id ';

$prep = $pdo->prepare($req);
$prep->bindValue(':id', $id, PDO::PARAM_INT);
$prep->execute();

return $prep->fetchAll();


}

function getVilles($id){
  global $pdo;

  $req = 'SELECT * FROM City WHERE idCountry = :id';

  $prep = $pdo->prepare($req);
  $prep->bindValue(':id', $id, PDO::PARAM_INT);
  $prep->execute();
  return $prep->fetchAll();

}

function ajoutVille($id){
  global $pdo;

  $id = $_GET['id'];
  $nom = $_POST['nom'];
  $pop = $_POST['pop'];

  $req = 'INSERT INTO City(idCountry, Name, Population) VALUES (:id, :nom, :pop);';

  $prep = $pdo->prepare($req);
  $prep->bindValue(':id', $id, PDO::PARAM_INT);
  $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
  $prep->bindValue(':pop', $pop, PDO::PARAM_INT);
  $prep->execute();


}

/*function getIdCountry($name){
  global $pdo;

  $query='SELECT id FROM Country WHERE Name=:name';
  $prep=$pdo->prepare($query);
  $prep->bindValue(':name',$name,PDO::PARAM_STR);
  $prep->execute();
  return $prep;
}*/

function getAuthentification($pdo,$login,$pass){


  $query = "SELECT * FROM utilisateurs where login=:login and password=:pass";
  $prep = $pdo->prepare($query);
  $prep->bindValue(':login', $login);
  $prep->bindValue(':pass', $pass);
  $prep->execute()
;
  // on vérifie que la requête ne retourne qu'une seule ligne
  if($prep->rowCount() == 1){
    $result = $prep->fetch(PDO::FETCH_ASSOC); 
    return $result;
  }
 else
  return false;

}