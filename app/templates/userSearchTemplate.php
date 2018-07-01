<form>
    <br>
    <?foreach ($users as $user): ?>
        <a href="profile.php?controller=<?echo $user?>"><?echo $user?></a><br>

    <? endforeach; ?>
    <br>
</form>