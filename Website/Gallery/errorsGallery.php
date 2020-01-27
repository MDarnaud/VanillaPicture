<?php  if (count($errors) > 0) : ?>
<div class="error">
        <p>
            <?php foreach ($errors as $error) : ?>
                <?php echo $error?>
            <?php endforeach ?>
        </p>
    </div>
<?php  endif; ?>

