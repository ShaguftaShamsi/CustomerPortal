<h1>Login</h1>
<div id="container">
<?php
 $errorsLogin = $this->Session->flash();
  
  
//debug($errorsLogin);
	echo '<span>';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
  //$this->Cookie->read('users_cookie.id')
echo $this->Form->create('User');
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->checkbox('checked') .'Keep me login';

echo $this->Form->end('Login');?>

<div id ='option'>
<?
echo $this->Html->link('Forget?',array('action'=> 'forgetPassword')); 
?>
</div>
</div>



