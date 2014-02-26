
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:15px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
<h1>View Tickets</h1>
<table class='gridtable'>
    <tr>
        <th>Id</th>
        <th>Issue</th>
         <th>Assign to</th>
         <th>Status</th>
         <th>Priority</th>
        <th>Created at</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Ticket']['id']; ?></td>
         <?php  if($post['Ticket']['issue'] =='1')
                  $issue ='Troubleshooting';
 else     $issue =='Network Failure';?>
        <td><?php echo $issue; ?></td>
          <td><?php echo "Admin"; ?></td>
            <?php  if($post['Ticket']['status']==1)
                  $status ='Open';  
                 else if($post['Ticket']['status']==2)
                            $status ='Close';  
                 else 
                 $status ='Pending';  
             ?>
        <td><?php echo $status; ?></td>
                  <?php  if($post['Ticket']['priority']==1)
                  $priority ='High';  
                 else if($post['Ticket']['priority']==2)
                            $priority ='Medium';  
                 else 
                 $priority ='Low';  
             ?>
         <td><?php echo $priority; ?></td>
        <td><?php echo $post['Ticket']['created_at']; ?></td>
    </tr>
   <?php endforeach; ?>
    <?php unset($post); ?>
</table>
