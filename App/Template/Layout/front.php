<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
    <!-- Custom framework css -->
    <link rel="stylesheet" href="<?= INDEX_URL ?>public/Css/front.css">
    <style>
        .uk-container-small {
            max-width: 1020px;
        }
    </style>
    <!---link rel="stylesheet" href="<?= INDEX_URL ?>/public/Css/uikit.min.css"-->
    <!-- UIkit CSS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?=$this->content('head')?>
</head>
<body class="uk-section-muted">
<?php include(ROOT_PATH . '/App/Template/Header/front.header.php');?>
<section class="uk-section uk-section uk-section-muted uk-padding-remove-bottom">
   <div class="uk-container uk-container-expand">
    <?php $messages = src\Flash\Flash::get()?>
    <?php if(!empty($messages)){ ?>
        <?php foreach($messages as $message){?>
            <div class="uk-alert-<?=$message['type']?>" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?=$message['message']?></p>
            </div>
        <?php } ?>
    <?php } ?>
    <?=$this->content('body')?>
   </div>
</section>
<?php include(ROOT_PATH . '/App/Template/Footer/front.footer.php');?>
<!-- UIkit JS -->
<script src="<?= INDEX_URL ?>public/Js/uikit.js"></script>
<script src="<?= INDEX_URL ?>public/Js/uikit-icons.min.js"></script>
<script src="<?= INDEX_URL ?>public/Js/init.js"></script>
<script src="<?= INDEX_URL ?>public/Js/app.js"></script>
<script src="<?= INDEX_URL ?>public/Js/user.js"></script>
<script src="<?= INDEX_URL ?>public/Js/role.js"></script>
<script src="<?= INDEX_URL ?>public/Js/permission.js"></script>
<script src="<?= INDEX_URL ?>public/Js/export.js"></script>
</body>
</html>