<?php $this->view('inc/header'); ?>

<div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="<?= URLROOT; ?>/users" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?= $data->image; ?>" alt="image">
        <div class="details">
          <span><?= $data->username; ?></span>
        </div>
      </header>
      
      <div class="chat-box">

      </div>

      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="userTo" value="<?= $data->userId; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fa-solid fa-paper-plane"></i></button>
      </form>
    </section>
  </div>

  <?php $this->view('inc/footer'); ?>