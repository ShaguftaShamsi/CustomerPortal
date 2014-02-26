<?php if(!empty($heading)){?>
<h1><?=$heading;?></h1>
<?php   }?>

 
<div id="container">
<?php
 $errorsLogin = $this->Session->flash();

//debug($errorsLogin);
	echo '<span>';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
echo $this->Form->create('User');
echo $this->Form->input('email',array('value' => $this->Session->read('resetEmail')));
echo $this->Form->input('password');
echo $this->Form->input('confirm_password',array('type'=>'password'));
echo $this->Form->end('Send');?>

</div>
