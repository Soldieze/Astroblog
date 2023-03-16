<?php

include './partials/header.php';

?>

<form action="POST" style="display:flex; flex-direction:column; width: 30%; margin:2rem;">
    <label for="name">Nom : </label>
    <input type="text" name="name" id="name">

    <label for="last_name">Nom de famille : </label>
    <input type="text" name="last_name" id="last_name">

    <label for="birth">Date de Naissance : </label>
    <input type="date" name="birth" id="birth">

    <label for="email">Email : </label>
    <input type="email" name="email" id="email">

    <label for="pwd">Mot de passe : </label>
    <input type="password" name="pwd" id="pwd">

</form>

