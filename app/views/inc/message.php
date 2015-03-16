<div  class="msg">
    <div class="sender msg_info">
        <?php
            if($msg['sender_id'] == $_SESSION['user_id']){
                echo "you";
            }else{
                $user = new User();
                echo $user->getUsername($msg['sender_id']);
            }
        ?>
    </div> said at:

    <div class="date_sent msg_info">
        <?php echo $msg['sent_at']; ?>
    </div>

    <div class="msg_content msg_info">
        <?php echo $msg['content']; ?>
    </div>
</div>