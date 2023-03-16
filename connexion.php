<?php 
session_start();
include './partials/header.php';

$email = $pwd = $errors = '';

?>

<?php
/*
 * Formulaire de connexion
 */

include './inc/fonctions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
    $email = cleanData($_POST['email']);
    $pwd = cleanData($_POST['pwd']);

    if ($email) :
        
        if (findEmail($email)) :
            if (password_verify($pwd, findEmail($email)['user_pwd'])) :
                $_SESSION['login'] = true;
                
                if (findEmail($email)['role'] === 'admin') :
                    redirectUrl('admin_home.php');
                 
                endif;

                redirectUrl("user_home.php");
                echo "connected";
            else :
                $errors[] = 'Le mot de passe est non valide.';
            endif;
        else :
            echo 'Votre email n\'est pas enregistré comme utilisateur de notre site.<br>';
            echo 'Veuillez vous enregister avec <a href="../register">ce formulaire</a>';
            exit();
        endif;

    else :
        $errors[] = 'Votre email est manquant ou incorrect !';
    endif;

endif;
?>

<form method="POST" style="display:flex; flex-direction:column; width: 30%; margin:2rem;">
    <label for="email">Email : </label>
    <input type="email" name="email" id="email" value="<?= $email ?>">

    <label for="pwd">Mot de passe : </label>
    <input type="password" name="pwd" id="pwd" value="<?= $pwd ?>">

    <input type="submit" name="submit">

</form>