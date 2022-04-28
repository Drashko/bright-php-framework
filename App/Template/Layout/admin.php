<!doctype html>
<html lang="en">
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="../../../css/uikit.min.css">
    <!-- Custom framework css -->
    <link rel="stylesheet" href="../../../css/dashboard.css">
    <link rel="stylesheet" href="../../../css/modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?=$this->content('head')?>
</head>
<body>
<?php include(ROOT_PATH . '/App/Template/Header/admin.header.php');?>
<div id="content" class="uk-overflow-container" data-uk-height-viewport="expand: true" >
    <div class="uk-container admin uk-container-expand">
        <?php $messages = src\Flash\Flash::get();?>
        <?php if(!empty($messages)){ ?>
            <?php foreach($messages as $message){?>
                <div class="uk-alert-<?=$message['type']?>" uk-alert style="">
                    <a class="uk-alert-close" uk-close></a>
                    <p><?=$message['message']?></p>
                </div>
            <?php } ?>
        <?php } ?>
        <?=$this->content('body')?>
    </div>
</div>
<?php include(ROOT_PATH . '/App/Template/Footer/admin.footer.php');?>
    <!-- UIkit JS -->
    <script src="<?= INDEX_URL ?>/public/Js/uikit.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/uikit-icons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/init.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/app.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/dom.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/ajax.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/modal.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/user.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/role.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/permission.js"></script>
    <script src="<?= INDEX_URL ?>/public/Js/export.js"></script>

    <!--script src="<?= INDEX_URL ?>/Public/js/validate.js"></script-->
</body>
</html>