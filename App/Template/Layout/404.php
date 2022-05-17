<?php $this->start('body');?>
Hmm..you are lost?!
<br>
<br>
<br>
Go back to home page!
<a class="uk-button-primary uk-button" href="<?=$this->url('/home/index/')?>">Go to Home page</a><br>
<br>
<br>
<br>
If you are Administrator
<a class="uk-button-primary uk-button" href="<?=$this->url('/admin/dashboard/index/')?>">Go to Admin area</a>
<?php $this->end();?>
