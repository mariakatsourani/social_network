<aside>
	<ul>
        <li class="side_links" ><a href="">Find people</a></li>
        <li class="side_links" ><a href="http://localhost/mvc_app/public/friendship/showAll">Your friends</a></li>
        <ul>
            <?php
            $fs = new Friendship();
            $friends = $fs->getAll();
            foreach($friends as $friend){
                foreach($friend as $key => $value){
                    if($key == 'username'){?>
                        <li class="side_links friends">
                            <a href='http://localhost/mvc_app/public/user/profile/<?php echo $value ?>'><?php echo $value ?></a>
                            <a href='http://localhost/mvc_app/public/message/read/<?php echo $value ?>'>Msg</a>
                        </li>
                    <?php }
                }
            }

            ?>
        </ul>
	</ul>
</aside>
