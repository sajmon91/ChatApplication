<?php $this->view('inc/header'); ?>

  <div class="wrapper">
    <section class="form login">
      <header>Chat App</header>
      <form action="<?=URLROOT;?>/users/login" method="POST" autocomplete="on">
        <div class="error-text"></div>
        <div class="success-text"><?php displayMessage(); ?></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" class="email" value="<?= $data['email']; ?>" required>
          <span class="invalid"><?= $data['email_err']; ?></span>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" class="password" required>
          <span class="invalid"><?= $data['password_err']; ?></span>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Login">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="<?=URLROOT;?>/users/register">Signup now</a></div>
    </section>
  </div>

  <?php $this->view('inc/footer'); ?>