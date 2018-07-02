<?php
if(empty($posts)){
    echo 'Nema više postova za prikazati';
}
foreach ($posts as $post):
?>
<a href="profile.php?controller=<?echo $post->getUser()?>"><?echo $post->getUser()?></a>
<h2><?echo $post->getText()?></h2>
<? echo $post->getDateTime()->format('Y-m-d H:i:s')?>
<br><br>

<? endforeach; ?>

<form>
    <br>
    <?if(!empty($_GET['controller'])):?>
        <input type="hidden" name="controller" value="<?echo $_GET['controller'] ?? ''?>">

    <? endif ;?>
    <input type="submit" value="početak" name="stranica">
    <input type="submit" value="prethodna" name="stranica">
    <input type="submit" value="sljedeća" name="stranica">

    <br>
</form>