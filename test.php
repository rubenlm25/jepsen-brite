<?php
session_start();
require './include/header.php';

 <div class='comment'>
                        <form action='eventpage.php?id=<?php echo $id; ?>' method='POST'>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                            <textarea name="comment" id="comment_editor" style="resize : none;" placeholder="Comments..."></textarea>
                            <!--<textarea name='comment' id="comment_editor" style="resize : none;"></textarea><br>-->
                            <input type='submit' value='Send comment' name="send">
                            <?
                            $display_comments = $bdd->prepare('SELECT * FROM comment where id_event=? ORDER BY date_time DESC ');
                            $display_comments ->execute(array($id));

                             while ($data_comment = $display_comments->fetch()){
                                 echo $data_comment['author']."<br>";
                                 echo $data_comment['message']."<br>";
                                 echo $data_comment['date_time']."<br>";
                             };

                            ?>


