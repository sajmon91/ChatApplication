  
  <?php if (!empty($data)): 
    
    foreach ($data as $chat):
      if ($chat->userFrom == $_SESSION['user_id']) :?>

    <div class="chat outgoing">
      <div class="details">
          <p><?= $chat->msg; ?></p>
      </div>
    </div>

    <?php else: ?>

    <div class="chat incoming">
      <img src="<?= $chat->image; ?>" alt="image">
      <div class="details">
          <p><?= $chat->msg; ?></p>
      </div>
    </div> 

  <?php endif; endforeach; endif; ?>