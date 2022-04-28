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
            <h3>Registration</h3>
        </header>
        <!-- register -->
        <form class="toggle-class" action="<?=$this->url('register/index/')?>" method="post">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $_POST['name'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: mail"></span>
                        <input class="uk-input uk-border" required placeholder="Email" name="email" type="email" value="<?= $_POST['email'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                        <input class="uk-input uk-border" required placeholder="Password" name="password" type="password" value="<?= $_POST['password'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                        <input class="uk-input uk-border" required placeholder="Repeat password" name="password_confirm" type="password" value="<?= $_POST['password_confirm'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <label>
                        <input class="uk-checkbox" type="checkbox" name="terms" <?php if(isset($_POST['terms'])) { echo 'checked="checked"';}?>>
                        <div>
                            I have read, understood and agree to the website
                            <a href="">Terms and Conditions</a>
                            and consent to the processing of my personal data as detailed in the
                            <a href="">Privacy Notice</a> and the <a href>Cookie Policy.</a>
                        </div>
                    </label>
                </div>
                <div class="uk-margin-bottom">
                    <button type="submit" class="uk-button uk-button-primary uk-border uk-width-1-1">Register</button>
                </div>
            </fieldset>
        </form>
    </div>
<?php $this->end()?>