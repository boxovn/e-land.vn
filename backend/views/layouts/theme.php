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
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo yii::$app->urlManager->baseUrl?>/theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo yii::$app->urlManager->baseUrl?>/theme/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo yii::$app->urlManager->baseUrl?>/theme/dist/css/skins/_all-skins.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/iCheck/all.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script type="text/javascript">
    // Common params using for JS
    var _jsBaseUrl = '<?php echo yii::$app->urlManager->baseUrl?>';
    </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <?php //$this->beginBody() ?>

    <div class="wrapper">

        <?php echo Menu::widget() ?>

        <?php echo Navi::widget() ?>

        <?= $content ?>

        <?php echo Footer::widget() ?>

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php //$this->endBody() ?>

    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script
        src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js">
    </script>
    <!-- Slimscroll -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/slimScroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/fastclick/fastclick.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/iCheck/icheck.min.js"></script>
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

</body>

</html>
<?php $this->endPage() ?>