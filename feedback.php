<?php include 'inc/header.php'; ?>

<?php 
  $sql = 'SELECT * FROM feedback';
  $result = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
    <h2>Past Feedback</h2>

    <?php if(empty($feedback)): ?>
      <p class="lead mt3">There is no feedback</p>
    <?php endif; ?>

    <?php foreach($feedback as $item): ?>
    <div class="card my-3 w-75"> 
     <div class="card-body text-center">
       <?php echo '#' . $item['id'] . ' - ' . $item['body']; ?>
       <div class="text-secondary mt-2">
        By <?php echo $item['name']; ?> on <?php echo $item['time']=date("g:ia"); ?> on <?php echo $item['date']=date("l jS F"); ?>
       </div>
       <div class="text-dark mt-3">
        Rating: 
        <?php 
          switch($item['rating']) {
            case 1:
              echo '*';
              break;
            case 2:
              echo '**';
              break;
            case 3:
              echo '***';
              break;
            case 4:
              echo '****';
              break;
            case 5:
              echo '*****';
              break;
            default:
              echo 'no rating';
          }
        ?>
       </div>
       <div class>
        <a href='<?php echo $item['video']; ?>'> <?php echo $item['video']; ?> </a>
       </div>
     </div>
   </div>
   <?php endforeach; ?>

<?php include 'inc/footer.php'; ?>
