<?php
  include('config/db_connection.php');

  // write query for all auctions
$sql = 'SELECT item, bid, id, created_at, sname, email FROM auc ORDER BY created_at';

//make query and get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$aucs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result form memory
mysqli_free_result($result);

//close connection 
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
  <div class="container center">
   <h4 style="color: grey" class="center">Items</h4>
   <h6 style="color: red" class="center">Bids placed after 12:00am eastern time are not valid!</h6>
   <h6 style="color: grey" class="center">Emails will be sent to top bidders</h6>
   <p style="color: grey" class="center">Date: <?php echo date("Y-m-d") ?></h6>
   <p style="color: grey" class="center">Time: <?php echo date("h:i:sa") ?></p>
    <div class="row">
    <?php foreach($aucs as $auc): ?>
      <div class="col s6 md3">
        <div class="card z-depth-0">
        
          <div class="card-content center">
            <h6>item no: <?php echo htmlspecialchars($auc['item']); ?></h6>
            <div>
              <ul>
                <?php foreach(explode(',', $auc['bid']) as $ing) { ?>
                  <li>Bid: $<?php echo htmlspecialchars($ing); ?></li>
                <?php } ?>
              </ul>
              <h6>Email: <?php echo htmlspecialchars($auc['email']); ?></h6>
              <h6>Product name: <?php echo htmlspecialchars($auc['sname']); ?></h6>
              <h6>Bid time: <?php echo htmlspecialchars($auc['created_at']); ?></h6>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>

<?php include('templates/footer.php'); ?>
</html>