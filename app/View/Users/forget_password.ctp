<div class="main content clearfix">
<div class='banner'>

<h2> Having trouble in Signing in?</h2>
</div>
<p></p>

<div class="card signin-card clearfix">
<?php
 $errorsLogin = $this->Session->flash();
  //debug($errorsLogin);
	echo '<span class="error">';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
echo $this->Form->create('User');
echo $this->Form->input('email',array('value'=>$this->Session->read('tempEmail.email'),'label'=>'',
'readonly'=> 'readonly'));
echo $this->Form->end('Send');?>
</div>
</div>
