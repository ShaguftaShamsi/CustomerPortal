<h1>Information</h1>
<p>User Information</p>         

<?php echo $this->Html->image('http://localhost/cake/'.$posts['Profile']['image']);?>


<div>
<fieldset>
<legend></legend>
<table>
<col width='50%'>

<tr><td>Organization</td>
 <td><?php echo ucwords(strtolower($posts['Profile']['company']));?></td></tr>
 <tr><td>Position</td>
 <td><?php echo ucwords(strtolower($posts['Profile']['position']));?></td></tr>
 <tr><td>Loacation</td>
 <td><?php echo ucwords(strtolower($posts['Profile']['location']));?></td></tr>
 <tr><td>Address</td>
 <td><?php echo ucwords(strtolower($posts['Profile']['address']));?></td></tr>
 </table>
 </fieldset>
 
 <fieldset>
 <legend></legend>
 <table>
 <col width='50%'>

   <tr><td> Name</td>
 <td><?php echo ucwords(strtolower($posts['Profile']['first_name'].' '.$posts['Profile']['last_name'])) ;?></td></tr>

 <tr><td>Birthday</td>
 <td><?php 
   $time =strtotime($posts['Profile']['birthday']); 
  $month =date('M',$time);
   $date =date('d',$time);
 echo $date. '-'.$month;?></td></tr>
 </table>
 </fieldset>
 </div>
