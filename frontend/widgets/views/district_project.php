<a href="<?php echo Yii::$app->params['elandUrl'];?>" title="Tất cả"><span class="label label-danger ">Tất cả</span></a>
<?php foreach ($districts as $key => $value) { ?>
	<a href="<?php echo yii::$app->urlManager->createUrl(['project/index','slug' => $value->slug]); ?>" title="<?php echo $value->name; ?>"><span class="label label-danger"><?php echo $value->type; ?> <?php echo $value->name; ?></span></a>
<?php } ?>
<?php foreach ($districts1 as $key => $value) { ?>
	<a href="<?php echo yii::$app->urlManager->createUrl(['project/index','slug' => $value->slug]); ?>" title="<?php echo $value->name; ?>"><span class="label label-danger"><?php echo $value->type; ?> <?php echo $value->name; ?></span></a>
<?php } ?>
<?php foreach ($districts2 as $key => $value) { ?>
	<a href="<?php echo yii::$app->urlManager->createUrl(['project/index','slug' => $value->slug]); ?>" title="<?php echo $value->name; ?>"><span class="label label-danger"><?php echo $value->type; ?> <?php echo $value->name; ?></span></a>
<?php } ?>