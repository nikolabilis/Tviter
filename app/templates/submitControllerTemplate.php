<form>
    <br>
<?foreach ($values as $value): ?>

<input type="submit" value="<?= $value; ?>" name="controller">

<? endforeach; ?>
    <br>
</form>