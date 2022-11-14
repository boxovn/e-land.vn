<?php

/* @var $this \yii\web\View */
/* @var $content string */

use admin\assets\AppAsset;
use yii\helpers\Html;
use admin\widgets\Menu;
use admin\widgets\Navi;
use admin\widgets\Footer;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- jQuery 2.2.3 -->

    <!-- Theme style -->
    <script type="text/javascript">
    // Common params using for JS
    var _jsBaseUrl = '<?php echo yii::$app->urlManager->baseUrl?>';
    //  console.log(_jsBaseUrl);
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?php echo Menu::widget() ?>
        <?php echo Navi::widget() ?>
        <?= $content ?>
        <?php echo Footer::widget() ?>
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <?php $this->endBody() ?>
    <!-- AdminLTE App -->
</body>

</html>
<?php $this->endPage() ?>