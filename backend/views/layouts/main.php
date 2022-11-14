<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\Menu;
use backend\widgets\Navi;
use backend\widgets\Footer;
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
<!-- AdminLTE App -->
<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/dist/js/app.min.js"></script>
<!-- Common JS -->

<script type="text/javascript">
$(document).ready(function() {
    setActiveMenu();

    function setActiveMenu() {
        var url = window.location.href.toString();
        if (url.indexOf("?r=") != -1) {
            url = url.substr(url.indexOf("?r="), url.length);
            url = url.replace('?r=', '');
        } else {
            url = '';
        }
        $("section.sidebar ul.sidebar-menu li").each(function() {
            var link = $(this).data('link');
            if (url == '' && link == 'homepage') {
                $(this).addClass('active');
            }
            if (url.indexOf(link) != -1) {
                $(this).addClass('active');
            }
        });
    }
});
</script>

</html>
<?php $this->endPage() ?>