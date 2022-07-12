<?php $this->view('inc/header'); ?>

  <div class="wrapper">
    <section class="form signup">
      <header>Chat App</header>
      <form action="<?=URLROOT;?>/users/register" method="POST" id="signupForm" autocomplete="on">
        <div class="error-text"></div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" class="username" placeholder="Username" value="<?= $data['username']; ?>" required>
          <span class="invalid"><?= $data['username_err']; ?></span>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="email" name="email" class="email" placeholder="Enter your email" value="<?= $data['email']; ?>" required>
          <span class="invalid"><?= $data['email_err']; ?></span>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" class="pass" placeholder="Enter new password" required>
          <span class="invalid"><?= $data['password_err']; ?></span>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
      <div class="link">Already signed up? <a href="<?=URLROOT;?>/users/login">Login now</a></div>
    </section>
  </div>

  <?php $this->view('inc/footer'); ?>