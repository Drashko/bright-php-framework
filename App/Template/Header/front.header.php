<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <!--HEADER-->
    <header class="uk-box-shadow-small" style="background-color: white">
        <div class="uk-container uk-container-expand">
            <nav class="uk-navbar" id="navbar" data-uk-navbar>
                <div class="left-logo uk-flex uk-flex-middle">
                    <a class="uk-navbar-item uk-logo" href="<?=$this->url('home/index/')?>">Bright_PHP</a>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav uk-visible@m">
                        <li class="<?=($this->active('controller') == 'home' || $this->active('controller') == '' )   ? 'uk-active' : ''?>"><a href="<?=$this->url('home/index/')?>">Home</a></li>
                        <li class="<?=($this->active('controller') == "document" )  ? 'uk-active' : ''?>"><a href="<?=$this->url('document/index/')?>">Document</a></li>
                        <li class="<?=($this->active('controller') == 'profile' )   ? 'uk-active' : ''?>"><a href="<?=$this->url('profile/index/')?>">Profile</a></li>
                        <li class="<?=($this->active('controller') == 'contact' )   ? 'uk-active' : ''?>"><a href="<?=$this->url('contact/index/')?>">Contact</a></li>
                    </ul>
                    <div class="uk-navbar-item">
                        <a class="uk-navbar-toggle uk-hidden@m" data-uk-toggle data-uk-navbar-toggle-icon href="#offcanvas-nav"></a>
                        <a href="<?=$this->url('login/index/')?>" class="uk-button uk-button-secondary uk-visible@m"><span data-uk-icon="sign-in"></span>SIGN IN</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>