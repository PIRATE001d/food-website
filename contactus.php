<?php require_once('./config.php'); ?>
<?php global $currentPage; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="./css/contactstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
    <div class="header-logo">
    <a href="<?php echo APP_BASE_URL;?>/index.php"><img src="logo.svg" alt="logo" width="150px"; /></a>
    </div>
    </header>
    <div class="container">
        <div class="form-container">
          <div class="left-container">
            <div class="left-inner-container">
            <h2>Let's Chat</h2>
            <p>Whether you have a question, want to start a project or            simply want to connect.</p>
              <br>
              <p>Feel free to send me a message in the contact form</p>
          </div>
            </div>
          <div class="right-container">
            <div class="right-inner-container">
              <form method="POST" action="send-email.php" >
                  <h2 class="lg-view">Contact</h2>
            <h2 class="sm-view">Let's Chat</h2>
                 <p>* Required</p>
                  <div class="social-container">
                      <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                      <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                      <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                  </div>
                <input type="text" name="fname" placeholder="Name *"  />
            <input type="email" name="email" placeholder="Email *" />
                  <input type="phone" name="number" placeholder="Phone" />
                <textarea rows="4" name="sujet" placeholder="Message"></textarea>
                  <button type="submit" name="send">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>  
</body>
</html>