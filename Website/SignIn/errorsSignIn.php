<?php  if (count($errors) > 0) : ?>
    <div class="error">
        <p>
        <?php foreach ($errors as $error) : ?>
                <?php echo $error; ?>
            <?php if($error === 'Password is invalid. ') :?>
                <?php $_COOKIE['invalidPW'] = 'true' ?>
            <?php  endif ?>
        <?php endforeach ?>
        </p>
    </div>
<?php  endif ?>
