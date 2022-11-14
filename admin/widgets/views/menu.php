<header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b> </b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>E-land.vn</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl?>/theme/dist/img/avatar.png" class="user-image" alt="User Image">
                                <span class="hidden-xs" style="text-transform: capitalize;"><?php echo isset(Yii::$app->user->identity->name)?Yii::$app->user->identity->name:''; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo yii::$app->urlManager->baseUrl?>/theme/dist/img/avatar.png" class="img-circle" alt="User Image">
                                    <p style="text-transform: capitalize;">
                                        <?php echo isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:''; ?>
                                        <small style="text-transform: initial;">Member since 
                                        	<?php
                                        		if (isset(Yii::$app->user->identity->username)) { 
	                                        		$date = new DateTime(Yii::$app->user->identity->created_at);
													echo $date->format('F Y');
                                        		}
											?>
										</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left"></div>
                                    <div class="pull-right">
                                    	<form action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=site%2Flogout" method="post">
										    <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
										    <button type="submit" class="btn btn-default btn-flat">Logout</button>
										</form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>