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
            <h3>Contact us</h3>
            <h3>Let's get in touch</h3>
        </header>
        <!-- register -->
        <form class="toggle-class" action="<?=$this->url('contact/index/')?>" method="post">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $_POST['name'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: phone"></span>
                        <input class="uk-input uk-border" placeholder="Phone (optional) " name="phone" type="text" value="<?= $_POST['phone'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                        <input class="uk-input uk-border" required placeholder="Email" name="email" type="email" value="<?= $_POST['email'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <textarea class="uk-textarea" rows="5" required placeholder="Text" name="message" type="textarea" ><?= $_POST['message'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="uk-margin-bottom">
                    <button type="submit" class="uk-button uk-button-primary uk-border uk-width-1-1">Send</button>
                </div>
            </fieldset>
        </form>
    </div>
<?php $this->end()?>