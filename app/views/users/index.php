<?php $this->view('inc/header'); ?>

<div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <img src="<?= $data['user']->image; ?>" alt="image">
          <div class="details">
            <span><?= $data['user']->username; ?></span>
          </div>
        </div>
        <div class="buttons">
          <a href="<?=URLROOT;?>/users/logout" class="logout">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
          <a href="<?=URLROOT;?>/groups/newGroup" class="group">Group <i class="fa-solid fa-plus"></i></a>
        </div>
      </header>
      <div class="search">
        <span class="text">Select user or group to chat</span>
        <input type="text" placeholder="Search user or group...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

        <?php 

        if(empty($data['others']) && empty($data['groups'])): ?>
          <p class="no-users">No users or groups are available to chat</p>  
        <?php else: 

          foreach ($data['groups'] as $group) : ?>
              <a href="<?=URLROOT;?>/groups/<?= $group->groupId; ?>">
                  <div class="content">
                    <img src="<?=URLROOT;?>/public/img/group.jpg" alt="image">
                    <div class="details">
                      <span><?= $group->groupName; ?></span>
                    </div>
                  </div>
              </a>
          <?php endforeach;

          foreach ($data['others'] as $other) : ?>
            <a href="<?=URLROOT;?>/chats/<?= $other->userId; ?>">
                <div class="content">
                  <img src="<?= $other->image; ?>" alt="image">
                  <div class="details">
                    <span><?= $other->username; ?></span>
                  </div>
                </div>
            </a>
        <?php endforeach; endif;?>

      </div>
    </section>
  </div>

  <?php $this->view('inc/footer'); ?>