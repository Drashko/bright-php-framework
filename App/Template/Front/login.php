<?php $this->start('body')?>
    <div class="uk-width-large uk-padding-small">

        <?php if(isset($data['errors'])){ ?>
            <?php foreach($data['errors'] as $error) { ?>
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?=$error?></p>
                </div>
            <?php  } ?>
        <?php  } ?>
        <header>
            <h3>Login</h3>
        </header>
        <!-- login -->
        <form class="toggle-class" action="<?=$this->url('login/index/')?>" method="post">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                        <input class="uk-input uk-border" required placeholder="Email" name="email" type="email" value="<?=$_POST['email'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                        <input class="uk-input uk-border" required placeholder="Password" name="password" type="password" value="<?=$_POST['password'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <label><input class="uk-checkbox" name="remember_me" <?=isset($_POST['remember_me']) ? "checked='checked'" : ''?> type="checkbox"> Keep me logged in</label>
                </div>
                <div class="uk-margin-bottom">
                    <button type="submit" class="uk-button uk-button-primary uk-border uk-width-1-1">LOG IN</button>
                </div>
            </fieldset>
        </form>
        <!-- /login -->

        <!-- recover password -->
        <form class="toggle-class" action="login-dark.html" hidden>
            <div class="uk-margin-small">
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: mail"></span>
                    <input class="uk-input uk-border-pill" placeholder="E-mail" required type="text">
                </div>
            </div>
            <div class="uk-margin-bottom">
                <button type="submit" class="uk-button uk-button-primary uk-border-pill uk-width-1-1">SEND PASSWORD</button>
            </div>
        </form>
        <!-- /recover password -->

        <!-- action buttons -->
        <div class="uk-margin-small>
            <p class="uk-text-center">
                <div class="uk-margin-small"><a href="<?=$this->url('register/index/')?>" class="uk-link-reset uk-text-medium toggle-class" data-uk-toggle="target: .toggle-class ;animation: uk-animation-fade">Registration</a></div>
                <!--a class="uk-link-reset uk-text-small toggle-class" data-uk-toggle="target: .toggle-class ;animation: uk-animation-fade">Forgot your password?</a>
                <a class="uk-link-reset uk-text-small toggle-class" data-uk-toggle="target: .toggle-class ;animation: uk-animation-fade" hidden><span data-uk-icon="arrow-left"></span> Back to Login</a-->
            </div>
        </div>
        <!-- action buttons -->
    </div>
</div>
<?php $this->end()?>