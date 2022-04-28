</main>
<br>
<br>
<!--FOOTER-->
<footer class="uk-section-secondary" style="position: fixed; bottom: 0; width: 100%;">
    <div class="uk-section uk-section-xsmall" style="background-color: rgba(0,0,0,0.15)">
        <div class="uk-container">
            <div class="uk-grid uk-child-width-1-2@s uk-text-center uk-text-left@s" data-uk-grid>
                <div class="uk-text-small uk-text-muted">
                    Copyright 2022 - All rights reserved.
                </div>
                <div class="uk-text-small uk-text-muted uk-text-center uk-text-right@s">
                    <a href="https://github.com/zzseba78/Kick-Off">Created by KickOff</a> | Built with <a href="http://getuikit.com" title="Visit UIkit 3 site" target="_blank" data-uk-tooltip><span data-uk-icon="uikit"></span></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/FOOTER-->
<!-- OFFCANVAS -->
<div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
        <button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
        <ul class="uk-nav uk-nav-default">
            <li class="uk-active"><a href="#">Menu</a></li>
            <li class="uk-parent">
                <a href="<?=$this->url('home/index/')?>">Home</a>
                <!--ul class="uk-nav-sub">
                    <li><a href="#">Sub item</a></li>
                    <li><a href="#">Sub item</a></li>
                </ul-->
            </li>
            <li class="uk-parent"><a href="<?=$this->url('profile/index/')?>">Profile</a></li>
            <li class="uk-parent"><a href="<?=$this->url('document/index/')?>">Document</a></li>
        </ul>
    </div>
</div>
<!-- /OFFCANVAS -->

</body>
</html>