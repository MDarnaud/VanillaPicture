
<?php $i =0; $len = count($errors);?>

<?php  if (count($errors) > 0) : ?>
    <div class="error">
        <p>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error?>
                <?php if (!($i == $len-1)) : ?>
                    <?php echo ', '?>
                <?php  endif ?>
            <?php $i++; ?>
        <?php endforeach ?>

        <?php  if (count($errors) == 1) : ?>
            <?php echo 'is required.'?>
        <?php else :?>
                <?php echo 'are required.'?>
        <?php  endif ?>

        </p>
    </div>
<?php  endif ?>