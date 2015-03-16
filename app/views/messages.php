<?php $pageTitle = "Messages";
include 'inc/overall/header.php';
include 'inc/aside.php'; ?>

<div id="messages">
    <div id="conversation">
        <?php
        foreach($data['msgs'] as $msg){
            include 'inc/message.php';
        }
        ?>
    </div>

    <form method="post" action="http://localhost/mvc_app/public/message/send/<?php echo $data['to'] ?>" id="send_msg">
        <input type="text" name="msg_content" placeholder="Enter your message here..."/>
        <input type="submit" name="submit" value="Send" />
    </form>
</div>

<?php include 'inc/overall/footer.php' ?>