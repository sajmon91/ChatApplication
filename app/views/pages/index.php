<?php $this->view('inc/header'); ?>

<div class="wrapper">
    <section class="index">
      <h1>Welcome to Chat App</h1>
      <div class="links">
        <a href="<?=URLROOT;?>/users/login">Login</a>
        <a href="<?=URLROOT;?>/users/register">Register</a>
      </div>
    </section>
  </div>

 <?php $this->view('inc/footer'); ?>