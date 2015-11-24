Cher <?= $user->nom ?> <?=$user->prenom ?>
<br>
Cliquez sur le lien suivant pour activer votre nouvelle adresse email: <?=anchor("/activation/" .  $activation_key, "Activer")?>
<br>
Merci,
<br>
L'&eacute;quipe Theknowledgebase