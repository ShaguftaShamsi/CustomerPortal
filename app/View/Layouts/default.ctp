<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	
	<title>Tasks</title>
	<?php 	echo $this->Html->css('cake.generic'); 
             echo $this->Html->script('countries');
          echo $scripts_for_layout;?>
</head>

<body>
	
		<div id="navigation">
		  
	        <?php if($this->Session->check('Users')){
			 echo $this->Html->link('Logout',
                            array('controller' => 'users',
                            'action' => 'logout')); ?>
| 
                             <?php echo $this->Html->link('Create Ticket',
                            array('controller' => 'tickets',
                            'action' => 'create'));}
							else 
							{echo $this->Html->link('Login',
                            array('controller' => 'users',
                            'action' => 'login')); }?>
		</div>
		<div id="content"><?php echo $content_for_layout; ?></div>
		<div id="footer">
                    Copyright © <?php echo date("Y"); ?>. All Rights Reserved.
                </div>
	
</body>
</html>
