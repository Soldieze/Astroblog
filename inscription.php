<?php

session_start();
include './partials/header.php';
include './inc/fonctions.php';

$name = $last_name = $email = $pwd = $errors = '';


if ($_SERVER['REQUEST_METHOD']==='POST'){
    $name = cleanData($_POST['name']);
    $last_name = cleanData($_POST['last_name']);
    $birth = cleanData($_POST['birth']);
    $email = cleanData($_POST['email']);
    $pwd = cleanData($_POST['pwd']);

    if ($email && $pwd){
        if (findEmail($email)){
            $errors = 'Veuiller choisir un autre email car cette utilisateur existe déjâ';
        } else {
            new_user($name, $last_name, $birth, $email, $pwd);
            $_SESSION['name'] = true;
            header('Location: ../AstroBlog/home.php');
            exit();
        } 
    }else {
            $errors = "Votre email ou mot de masse sont incorrect !";
        }
}

?>

<form method="POST" style="display:flex; flex-direction:column; width: 30%; margin:2rem;">
    <label for="name">Prénom : </label>
    <input type="text" name="name" id="name" value="<?= $name ?>">

    <label for="last_name">Nom de famille : </label>
    <input type="text" name="last_name" id="last_name" value="<?= $last_name ?>">

    <label for="birth">Date de Naissance : </label>
    <input type="date" name="birth" id="birth">

    <label for="email">Email : </label>
    <input type="email" name="email" id="email" value="<?= $email ?>">

    <label for="pwd">Mot de passe : </label>
    <input type="password" name="pwd" id="pwd" value="<?= $pwd ?>">

    <input type="submit" name="submit">

</form>







