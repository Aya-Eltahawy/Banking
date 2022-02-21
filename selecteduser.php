<?php
include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     $from = $_POST["from"];
     $to = $_POST["to"];
     $amount = $_POST["amount"];

     $stmt = $con->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
     $stmt->execute([$amount, $from]);

     $stmt = $con->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
     $stmt->execute([$amount, $to]);

     $stmt = $con->prepare("INSERT INTO transaction(sender_id, receiver_id, amount) VALUES (?, ?, ?)");
     $stmt->execute([$from, $to, $amount]);

     header("Location: users.php");

     exit();
   }
?>

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
  

  if(!isset($_GET["id"])) {
      header("Location: users.php");
      exit();
  }

  $stmt = $con->prepare("SELECT * From users WHERE id = ?");
  $stmt->execute([$_GET["id"]]);

  $user = $stmt->fetch();

  $stmt = $con->prepare("SELECT * FROM users WHERE id != ?");
  $stmt->execute([$_GET["id"]]);

  $users= $stmt->fetchAll();
?>

	<div class="container">
        <h2 class="text-center pt-4">Transaction</h2>
            
            <br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <?php
                    ?>
                        <tr>
                            <td class="py-2"><?= $user["id"] ?></td>
                            <td class="py-2"><?= $user["name"] ?></td>
                            <td class="py-2"><?= $user["email"] ?></td>
                            <td class="py-2"><?= $user["balance"] ?></td>
                        </tr>
                    <?php
                ?>
                
            </table>
        </div>
        <br>
        <form method="post" name="tcredit" class="tabletext" action="selecteduser.php">
            <label>Transfer To:</label>
            <input type="hidden" name="from" value="<?= $_GET["id"] ?>">
            <select name="to" class="form-control">
                <option value="" disabled selected>Choose</option>
                <?php
                foreach($users as $user):
                    ?>
                        <option value="<?php echo $user["id"] ?>" ><?php echo $user["name"] ?> </option>

                    <?php
                endforeach;
                ?>
                
                <div>
            </select>
            <br>
            <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>