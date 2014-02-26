<h1>Forget Password</h1>
<div id="container">
<?php
 $errorsLogin = $this->Session->flash();

//debug($errorsLogin);
	echo '<span>';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
echo $this->Form->create('User');
echo $this->Form->input('email');
echo $this->Form->end('Send');?>

</div>
