<!--HEADER-->
<?php
use src\Config\Config;
$config = new Config();
$navigationList = $config->get('adminNavigation');

?>
<header id="top-head" class="uk-position-fixed">
    <div class="uk-container uk-container-expand uk-background-primary">
        <nav class="uk-navbar uk-light" data-uk-navbar="mode:click; duration: 250">
            <div class="uk-navbar-left">
                <div class="uk-navbar-item uk-hidden@m">
                    <a class="uk-logo" href="<?=$this->url('admin/dashboard/index/')?>"><img class="custom-logo" src="../../../img/dashboard-logo-white.svg" alt=""></a>
                </div>
                <ul class="uk-navbar-nav uk-visible@m">
                    <li><a href="#">Accounts</a></li>
                    <li>
                        <a href="#">Settings <span data-uk-icon="icon: triangle-down"></span></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">YOUR ACCOUNT</li>
                                <li><a href="#"><span data-uk-icon="icon: info"></span> Summary</a></li>
                                <li><a href="#"><span data-uk-icon="icon: refresh"></span> Edit</a></li>
                                <li><a href="#"><span data-uk-icon="icon: settings"></span> Configuration</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#"><span data-uk-icon="icon: image"></span> Your Data</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#"><span data-uk-icon="icon: sign-out"></span> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="uk-navbar-item uk-visible@s">
                    <form action="dashboard.html" class="uk-search uk-search-default">
                        <span data-uk-search-icon></span>
                        <input class="uk-search-input search-field" type="search" placeholder="Search">
                    </form>
                </div>
            </div>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li><a href="#" data-uk-icon="icon:user" title="Your profile" data-uk-tooltip></a></li>
                    <li><a href="#" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a></li>
                    <li><a href="#" data-uk-icon="icon:  sign-out" title="Sign Out" data-uk-tooltip></a></li>
                    <li><a class="uk-navbar-toggle" data-uk-toggle data-uk-navbar-toggle-icon href="#offcanvas-nav" title="Offcanvas" data-uk-tooltip></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--/HEADER-->
<!-- LEFT BAR -->
<aside id="left-col" class="uk-light uk-visible@m">
    <div class="left-logo uk-flex uk-flex-middle">
        <img class="custom-logo" src="../../../img/dashboard-logo.svg" alt="">
    </div>
    <div class="left-content-box  content-box-dark">
        <h4 class="uk-text-center uk-margin-remove-vertical text-light">John Doe</h4>

        <div class="uk-position-relative uk-text-center uk-display-block">
            <a href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center" data-uk-icon="icon: triangle-down; ratio: 0.7">Admin</a>
            <!-- user dropdown -->
            <div class="uk-dropdown user-drop" data-uk-dropdown="mode: click; pos: bottom-center; animation: uk-animation-slide-bottom-small; duration: 150">
                <ul class="uk-nav uk-dropdown-nav uk-text-left">
                    <li><a href="#"><span data-uk-icon="icon: info"></span> Summary</a></li>
                    <li><a href="#"><span data-uk-icon="icon: refresh"></span> Edit</a></li>
                    <li><a href="#"><span data-uk-icon="icon: settings"></span> Configuration</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#"><span data-uk-icon="icon: image"></span> Your Data</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#"><span data-uk-icon="icon: sign-out"></span> Sign Out</a></li>
                </ul>
            </div>
            <!-- /user dropdown -->
        </div>
    </div>

    <div class="left-nav-wrap">
       <!--Main navigation-->
        <ul id="menu" class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav uk-nav="multiple: true>
            <li class="uk-nav-header"></li>
            <?php foreach($navigationList as $navigation) : ?>
                <?php if(!isset($navigation['sub-nav'])) { ?>
                      <li id="<?=$navigation['name']?>" class="nav-item <?=($navigation['attr']['class'] == "uk-parent") ? 'uk-parent': ''?>" ><a href="<?=$this->url($navigation['link'])?>"><span <?=$navigation['attr']['data']?> <?=$navigation['attr']['class']?>></span><?=$navigation['name']?></a></li>
                <?php } else { ?>
                    <?php foreach($navigation['sub-nav'] as $item) : ?>
                        <li id="<?=$navigation['name']?>" class="nav-item <?=($navigation['attr']['class'] == "uk-parent") ? 'uk-parent': ''?>" >
                            <a href=""><span <?=$navigation['attr']['data']?> <?=$navigation['attr']['class']?>></span><?=$navigation['name']?></a>
                            <ul class="uk-nav-sub">
                                <?php foreach($item as $itm) : ?>
                                   <li><a href="<?=$this->url($itm['link'])?>"><?=$itm['name']?></li></a>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    <?php endforeach;?>
              <?php }?>
          <?php endforeach;?>

        <!--li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Templates</a>
            <ul class="uk-nav-sub">
                <li><a title="Article" href="https://zzseba78.github.io/Kick-Off/article.html">Article</a></li>
                <li><a title="Album" href="https://zzseba78.github.io/Kick-Off/album.html">Album</a></li>
                <li><a title="Cover" href="https://zzseba78.github.io/Kick-Off/cover.html">Cover</a></li>
                <li><a title="Cards" href="https://zzseba78.github.io/Kick-Off/cards.html">Cards</a></li>
                <li><a title="News Blog" href="https://zzseba78.github.io/Kick-Off/newsBlog.html">News Blog</a></li>
                <li><a title="Price" href="https://zzseba78.github.io/Kick-Off/price.html">Price</a></li>
            </ul>
        </li>
        <li><a href="#"><span data-uk-icon="icon: album" class="uk-margin-small-right"></span>Albums</a></li>
        <li><a href="#"><span data-uk-icon="icon: lifesaver" class="uk-margin-small-right"></span>Tips</a></li-->
        </ul>
        <div class="left-content-box uk-margin-top">

            <h5>Daily Reports</h5>
            <div>
                <span class="uk-text-small">Traffic <small>(+50)</small></span>
                <progress class="uk-progress" value="50" max="100"></progress>
            </div>
            <div>
                <span class="uk-text-small">Income <small>(+78)</small></span>
                <progress class="uk-progress success" value="78" max="100"></progress>
            </div>
            <div>
                <span class="uk-text-small">Feedback <small>(-12)</small></span>
                <progress class="uk-progress warning" value="12" max="100"></progress>
            </div>

        </div>

    </div>
    <div class="bar-bottom">
        <ul class="uk-subnav uk-flex uk-flex-center uk-child-width-1-5" data-uk-grid>
            <li>
                <a href="#" class="uk-icon-link" data-uk-icon="icon: home" title="Home" data-uk-tooltip></a>
            </li>
            <li>
                <a href="#" class="uk-icon-link" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a>
            </li>
            <li>
                <a href="#" class="uk-icon-link" data-uk-icon="icon: social"  title="Social" data-uk-tooltip></a>
            </li>

            <li>
                <a href="#" class="uk-icon-link" data-uk-tooltip="Sign out" data-uk-icon="icon: sign-out"></a>
            </li>
        </ul>
    </div>
</aside>
<script>

    const navList = document.querySelectorAll('.nav-item');
    navList.forEach(function(el){
        el.addEventListener('click', function(e){
            let id = this.id;
            //e.preventDefault();
            $.ajax({
                url: App.baseUrl() + 'ui/AdminNavigation/setActive/',
                type: 'POST',
                data : { id : id },
                success : function(resp){
                    if(resp.success){
                        console.log(resp);
                    }
                }
            });
        });
    });

   /* localStorage.setItem('myCat', 'Tom');

    const cat = localStorage.getItem('myCat');
    console.log(cat);*/
   /*window.onload = function(){
       Menu.init();
   }
    //const navList = document.querySelectorAll('.nav-link');

    const Menu = {
        'items' : '',
        'item'  : ''
    }

    Menu.init = function(){
        this.items = document.querySelectorAll('.nav-link');
        this.set();
        this.getLocalStorage();

    }
    Menu.set = function (){
       this.items.forEach(function(el){
           this.item = el;
           this.item.addEventListener('click', function(){
               //this.preventDefault();
               if(this.classList.contains("uk-open")){
                   this.classList.remove("uk-open");
                   window.localStorage.setItem("menu", "");
               }else{
                   window.localStorage.setItem("menu", 'op');
                   this.classList.add('uk-open');
               }
           });
       });
    }*/

    /*Menu.getLocalStorage = function (){
       console.log(window.localStorage.getItem("menu"));
       return window.localStorage.getItem("menu");
    }*/


    //const ariaList = document.querySelectorAll('.aria-menu');




    /*navList.forEach(function(el) {
        el.addEventListener('click', function () {
            if (!this.classList.contains('uk-open')) {
                localStorage.setItem("menu", "open");
            } else {
                localStorage.setItem("menu-state", " ");
                //this.classList.add('uk-open');
            }
        });
    });
    ariaList.forEach(function(el){
        if(localStorage.getItem("menu") === "open") {
            el.parentElement.classList.add('uk-open');
            el.setAttribute("aria-expanded", "true");
            el.firstElementChild.removeAttribute('hidden');
        }*/
       /* if(localStorage.getItem("menu") === " "){
            console.log('remove class');
            el.parentElement.classList.remove('uk-open');
            el.setAttribute("aria-expanded", "false");
        }*/
    //});

   // console.log(localStorage.getItem("menu-state"));
</script>
<!-- /LEFT BAR -->