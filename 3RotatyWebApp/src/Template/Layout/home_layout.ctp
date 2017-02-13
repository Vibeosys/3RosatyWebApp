<!DOCTYPE html>
<html lang="en">
    <head>
        <title>3Rosaty | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <meta name="keywords" content="3rosaty website, wedding party management, manage wedding party in dubai, dubai wedding party." />
        <meta name="description" content="3rosaty is designed to manage and organize all your wedding parties.. Managed by Golden Circle Management." />

        <meta property="fb:app_id" content=""/>
        <meta property="og:title" content="3rosaty website, wedding party management"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://3rosaty.com"/>
        <meta property="og:site_name" content="3rosaty"/>
        <meta property="og:description" content="3rosaty is designed to manage and organize all your wedding parties. Managed by Golden Circle Management."/>
        <meta property="og:image" content="http://3rosaty.com/img/logo-medium.png"/>
        <link href="android-app://com.3rosaty/http/" rel="alternate">

        <?= $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')); ?>
        <!-- css -->

        <?= $this->Html->css('design/bootstrap.min.css'); ?> 
        <?= $this->Html->css('design/slider-setting.css'); ?> 
        <?= $this->Html->css('design/style.css'); ?> 
        <?= $this->Html->css('design/font-awesome.min.css'); ?> 
        <?= $this->fetch('css'); ?>
        <!--// css -->


        <!-- font -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i,900,900i" rel="stylesheet">
        <!-- //font -->

        <?= $this->Html->scriptStart(); ?>
        <?= 'var WEBSITE_VIRTUAL_DIR_NAME = \'' . VIRTUAL_DIR_PATH . '\';' ?>
        <?= $this->Html->scriptEnd(); ?>
        <?= $this->fetch('scriptTop'); ?>
        <?= $this->fetch('script'); ?>
    </head>
    <body>
        <?= $this->fetch('content'); ?>
        <?= $this->element('footer'); ?>
        <?= $this->fetch('requestServicePopup'); ?>
        <?= $this->fetch('scriptBotton'); ?>
    </body>
</html>
