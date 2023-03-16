<?php

function dbug($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;'>";
   var_dump($valeur);
   echo "</pre>";
}

function dd($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;height: 500px;'>";
   var_dump($valeur);
   // print_r($valeur);
   echo "</pre>";
   die();
}

function new_user($name, $last_name, $birth, $email, $pwd){
    include './inc/pdo.php';
      
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $birth = $_POST["birth"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
      $pwd_hash= password_hash($pwd, PASSWORD_DEFAULT);
    $requete = 'INSERT INTO `user`(`user_name`, `user_last_name`, `user_birth`, `user_email`, `user_pwd`) VALUES ( :name, :last_name , :birth,:email, :pwd)';
    $res = $conn->prepare($requete);
    $res->bindValue(':name', $name, PDO::PARAM_STR);
    $res->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $res->bindValue(':birth', $birth, PDO::PARAM_STR);
    $res->bindValue(':email', $email, PDO::PARAM_STR);
    $res->bindValue(':pwd', $pwd_hash, PDO::PARAM_STR);
    $res->execute();
    return $conn->lastInsertId();

}

function cleanData($valeur)
{
   if (!empty($valeur) && isset($valeur)) :
      $valeur = strip_tags(trim($valeur));
      return $valeur;
   else :
      return false;
   endif;
}

function findEmail(string $email): array|bool
{
   include 'pdo.php';

   $requete = 'SELECT * FROM user where user_email = :email';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':email', $email, PDO::PARAM_STR);
   $resultat->execute();
   return $resultat->fetch();
}

function redirectUrl(string $path = ''): void
{
   $homeUrl = 'http://' . $_SERVER['HTTP_HOST']. '/AstroBlog' ;
   $homeUrl .= '/'. $path;
   header("Location: {$homeUrl}");
   exit();
}