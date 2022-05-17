<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
    <!-- Custom framework css -->
    <link rel="stylesheet" href="../../../public/Css/dashboard.css">
    <!--link rel="stylesheet" href="../../../public/Css/modal.css"-->
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
    <script src="../../../public/Js/uikit.js"></script>
    <script src="../../../public/Js/uikit-icons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="../../../public/Js/init.js"></script>
    <script src="../../../public/Js/app.js"></script>
    <script src="../../../public/Js/dom.js"></script>
    <script src="../../../public/Js/ajax.js"></script>
    <script src="../../../public/Js/modal.js"></script>
    <script src="../../../public/Js/user.js"></script>
    <script src="../../../public/Js/role.js"></script>
    <script src="../../../public/Js/permission.js"></script>
    <script src="../../../public/Js/export.js"></script>
    <script src="../../../public/Js/chartScripts.js"></script>
    <!--script src="<?= INDEX_URL ?>/Public/js/validate.js"></script-->
</body>
</html>