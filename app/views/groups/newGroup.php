<?php $this->view('inc/header'); ?>

  <div class="wrapper">

    <section class="group">
      <header>
        <a href="<?= URLROOT; ?>/users" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <h2>New Group</h2>
      </header>

      <form action="<?=URLROOT;?>/groups/newGroup" method="POST" class="group-form">
        <input type="text" name="group-name" class="input-field" placeholder="Group name" autocomplete="off">

        <div class="users-list">
          
          <?php foreach ($data as $user) : ?>
            <label class="container">
              <input type="checkbox" name="group-users[]" value="<?= $user->userId; ?>">
              <span class="checkmark"></span>
              <img src="<?= $user->image; ?>" alt="image">
              <?= $user->username; ?>
            </label>
          <?php endforeach; ?>

        </div>

        <button><i class="fa-solid fa-plus"></i> Save</button>
      </form>
      
    </section>
  </div>

<?php $this->view('inc/footer'); ?>