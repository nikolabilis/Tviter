<?
if(empty($messages)){
    echo 'Nema više poruka za prikazati';
}
foreach ($messages as $msg):?>
    Šalje: <a href="profile.php?controller=<?echo $msg->getSender()?>"><?echo $msg->getSender()?></a>
    Prima: <a href="profile.php?controller=<?echo $msg->getRecipient()?>"><?echo $msg->getRecipient()?></a><br>
    <h2><u><?echo $msg->getTitle()?></u></h2>
    <h4><?echo $msg->getMsg()?> </h4>
    <? echo $msg->getDateTime()->format('Y-m-d H:i:s')?>
    <br><br>

<? endforeach; ?>

<form>
    <br>
    <input type="hidden" value="Privatne poruke" name="controller">
    <input type="submit" value="početak" name="stranica">
    <input type="submit" value="prethodna" name="stranica">
    <input type="submit" value="sljedeća" name="stranica">
    <br>
</form>