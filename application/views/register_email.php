<?= $user = $data['user']; ?>

Cher <?= $user->nom ?> $user->prenom
<br>
veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription sur
<?=anchor()?>
<br>
<?=anchor("/activation/" .  $user->activation_key, "Activer mon compte")?>
<br>
Merci,
<br>
L'équipe Theknowledgebase
