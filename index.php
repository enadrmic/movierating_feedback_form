<?php include 'inc/header.php'; ?>

<?php 
  $name = $email = $body = $video = '';
  $nameErr = $emailErr = $bodyErr = $videoErr = $ratingErr = '';
  $rating = null;


  if(isset($_POST['submit'])) {
     
     if(empty($_POST['name'])) {
       $nameErr = 'Name is required';
     } else {
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     }

     if(empty($_POST['email'])) {
      $emailErr = 'Email is required';
    } else {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    if(empty($_POST['body'])) {
      $bodyErr = 'Feedback is required';
    } else {
      $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    if(empty($_POST['rating'] <= 5) || empty($_POST['rating'] >= 1)) {
      $ratingErr = 'Rating should be from 1 to 5';
    } else {
     $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
    }   


    if(empty($_POST['video'])) {
      $videoErr = 'Video URL is required';
    } else {
      $video = filter_input(INPUT_POST, 'video', FILTER_SANITIZE_URL);
    }   

    if(empty($nameErr) && empty($emailErr) && empty($bodyErr) && empty($videoErr) && empty($ratingErr)) {

      $sql = "INSERT INTO feedback (name, email, body, video, rating) VALUES ('$name', '$email', '$body', '$video', '$rating')";

      if(mysqli_query($conn, $sql)) {

        header('Location: feedback.php');
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }
?>
    <img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Feedback</h2>
    <p class="lead text-center">Leave feedback for Traversy Media</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control <?php echo $ratingErr ? 'is-invalid' : null; ?>" id="rating" name="rating" placeholder="Enter rating">
        <div class="invalid-feedback">
          <?php echo $ratingErr; ?>
        </div>
      </div>  
      <div class="mb-3">
        <label for="video" class="form-label">Video URL</label>
        <input type="url" class="form-control <?php echo $videoErr ? 'is-invalid' : null; ?>" id="video" name="video" placeholder="Enter video url">
        <div class="invalid-feedback">
          <?php echo $videoErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $emailErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $bodyErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>