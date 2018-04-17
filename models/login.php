<?php
  require_once('inc/manager-db.php');          


   if (isset($_POST['login']) && isset($_POST['pwd']) && !empty($_POST['login'])&& !empty($_POST['login'])) { 
      
      $result = getAuthentification($pdo,$_POST['login'],$_POST['pwd']);

      if($result){

        session_start (); 

        $_SESSION['nom'] = $result['nom']; 
        $_SESSION['identifiant'] = $result['iduser'];
        $_SESSION['role'] = $result['role'];
        
        header ('location: index.php'); 
      
      }

      else{

        header ('location: authentification.php');

      }

    }


    else {

          header ('location: authentification.php');
          
    }  
 ?> 

