<?php require_once('./config.php'); ?>
<?php global $currentPage; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style-login.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    
    <div class="container">
      <header>Login</header>
      
      <form action="logincode.php" method="POST">
        <div class="input-field">
          <input type="text" name="email" required>
          <label>Email</label>
        </div>
        <div class="input-field">
        <input class="pswrd" name="password" type="password" required>
          <span class="show">SHOW</span>
          <label>Password</label>
        </div>
        <div class="button">
          <div class="inner"></div>
          <button type="submit" name="login">LOGIN</button>
        </div>
      </form>
      <div class="auth">Or login with</div>
      <div class="links">
        <div class="facebook">
          <i class="fab fa-facebook-square"><span>Facebook</span></i>
        </div>
        <div class="google">
          <i class="fab fa-google-plus-square"><span>Google</span></i>
        </div>
      </div>
      <div class="signup">
        Not a member? <a href="<?php echo APP_BASE_URL; ?>/register.php">sign up</a>
      </div>
    </div>
    <script>
      var input = document.querySelector('.pswrd');
      var show = document.querySelector('.show');
      show.addEventListener('click', active);
      function active(){
        if(input.type === "password"){
          input.type = "text";
          show.style.color = "#1DA1F2";
          show.textContent = "HIDE";
        }else{
          input.type = "password";
          show.textContent = "SHOW";
          show.style.color = "#111";
        }
      }
    </script>

  </body>
</html>

