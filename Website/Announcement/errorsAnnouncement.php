
<?php $i =0; $len = count($errors);?>

<?php  if (count($errors) > 0) : ?>
    <div class="isa_error" >
        <i class="fa fa-times-circle"></i>
            <?php foreach ($errors as $error) : ?>
                <?php echo $error?>
            <?php endforeach ?>
    </div>
<?php  endif ?>
<?php if(count($errorsDate)>0):?>
    <div class="isa_error" >
        <i class="fa fa-times-circle"></i>
            <?php foreach ($errorsDate as $errorDate) : ?>
                <?php echo $errorDate ?>
            <?php endforeach ?>
    </div>
<?php endif;?>

<?php if(count($postAnnouncement)>0):?>
    <div class="isa_success" >
        <i class="fa fa-times-circle"></i>
            <?php foreach ($postAnnouncement as $post) : ?>
                <?php echo $post ?>
            <?php endforeach ?>
    </div>
<?php endif;?>

