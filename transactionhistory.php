<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
</head>

<body>

<?php
  include 'navbar.php';
  include 'connect.php';

  $stmt = $con->prepare("select * , (select name from users where transaction.sender_id = users.id)as sender , (select name from users where transaction.receiver_id = users.id) as receiver from transaction");

  $stmt->execute();

  $transactions= $stmt->fetchAll();

?>

	<div class="container">
        <h2 class="text-center pt-4">Transaction History</h2>
        
       <br>
       <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <?php
        foreach($transactions as $transaction):
            ?>
                <tr>
                    <td class="py-2"><?= $transaction["sno"] ?></td>
                    <td class="py-2"><?= $transaction["sender"] ?></td>
                    <td class="py-2"><?= $transaction["receiver"] ?></td>
                    <td class="py-2"><?= $transaction["amount"] ?></td>
                    <td class="py-2"><?= $transaction["datetime"] ?></td>
                   
                </tr>
            <?php
            endforeach;
        ?>
    </table>
       </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>    
</html>