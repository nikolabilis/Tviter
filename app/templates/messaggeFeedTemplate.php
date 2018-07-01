<?php
if(empty($posts)){
    echo 'Nema više postova za prikazati';
}
foreach ($msgs as $msg):
    ?>
    <a href="profile.php?controller=<?echo $post->getUser()?>"><?echo $post->getUser()?></a>
    <h2><?echo $post->getText()?></h2>
    <? echo $post->getDateTime()->format('Y-m-d H:i:s')?>
    <br><br>

<? endforeach; ?>

<form>
    <br>
    <input type="submit" value="početak" name="stranica">
    <input type="submit" value="prethodna" name="stranica">
    <input type="submit" value="sljedeća" name="stranica">
    <br>
</form>