<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/nav.css">

    <style type="text/css">
    	
		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#7f00ff;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>
<body>
 
<?php
  include 'navbar.php';
  include 'connect.php';

  $stmt = $con->prepare("SELECT * From users");
  $stmt->execute();

  $users = $stmt->fetchAll();

?>

	<div class="container">
        <h2 class="text-center pt-4">Transaction</h2>
            
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <?php
                    foreach ($users as $user)
                    {
                        ?>
                            <tr>
                                <td class="py-2"><?php echo $user["id"] ?></td>
                                <td class="py-2">
                                    <a href="selecteduser.php?id=<?= $user["id"] ?>"><?php echo $user["name"] ?></a>
                                </td>
                                <td class="py-2"><?= $user["email"]?></td>
                                <td class="py-2"><?= $user["balance"] ?></td>
                            </tr>
                        <?php
                    }
                ?>
                
            </table>
        </div>
        <br>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>