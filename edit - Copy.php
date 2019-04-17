//  ============= COMMENT IN HOME.PHP =========
    
    if(isset($_POST["postComment"])){
       $comment=$_POST["comment"];
       $p_id=$_POST["postId"];
       $uid =$_SESSION["uid"];
       $sql= "INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `content`, 
       `date_created`, `date_updated`) VALUES
        (NULL, '$p_id', '$uid', '$comment', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
      $run_query = mysqli_query($con,$sql);
    
      $sqll="SELECT * FROM `comments`
      INNER JOIN users ON
      comments.user_id=users.user_id
      INNER JOIN posts ON
      comments.post_id=posts.post_id
      WHERE comments.post_id='$p_id' AND comments.user_id='$comment'";
      $query = mysqli_query($con,$sqll);
      while($row =mysqli_fetch_array($query)){
          $content = $row["content"];
          $fname = $row["first_name"];
          $lname = $row["last_name"];
          $date =$row["comment.date-created"];
        
            echo "
         <div class='comment-sec'>
         <ul>
            <li>
              <div class='comment-list'>
              <div class='comment'>
             <h3>$fname $lname</h3>
                <span><img src='images/clock.png' alt=''>$date</span>
                <p>$content</p>
                </div>
             </div><!--comment-list end-->
             </li>
           </ul>
         </div>
             
         "; 
       }
       
         

}
//  ============= POST RETRIEVAL FUNCTION IN HOME.PHP =========

if(isset($_POST["getPost"])){
    $post_query = "SELECT * FROM posts
    INNER JOIN users ON
    posts.user_id=users.user_id
    INNER JOIN tags ON
    posts.post_id=tags.post_id";
    $run_query = mysqli_query($con,$post_query);

if(mysqli_num_rows($run_query)>0){
       while($row =mysqli_fetch_array($run_query)){
       $post_id =$row["post_id"];
       $location=$row["location"];
       $description =$row["post_content"];
       $caption =$row["caption"];
       $date =$row["post_time"];
       $first_name=$row["first_name"];
       $second_name=$row["last_name"];
       $tag=$row["tag_name"];

       echo"
										<div class='post-bar'>
											<div class='post_topbar'>
													<div class='usy-name'>
														<h3>$first_name $second_name</h3>
														<span><img src='images/clock.png' alt=''>$date</span>
													</div>
											</div>
											<div class='epi-sec'>
												<ul class='descp'>
													<li><i class='la la-map-marker'>$location</i></li>
												</ul>
											</div>
											
											<div class='job_descp'>
												<h3>$caption</h3>
												<p>$description</p>
												<div class='mapouter'>
                                                <ul class='skill-tags'>
                                                <li><a href='#' title=''>$tag</a></li>	
                                            </ul>
											</div>
											</div>
											<div class='job-status-bar'>
                                                <ul class='like-com'>
                                                   <li><div id='sms_comment-$post_id'></div></li>
                                                    <li> 
                                                    <div class='comment_box'>
                                                    <form> 
                                                    <ul>
													     <li><input type='text' pid='$post_id' id='comment-$post_id' name='comment' placeholder='Post a comment' value=''>
													     <button class='active commentpost' p_id='$post_id' type='submit'>Send</button></li>
                                                    </ul>
                                                    </form>
                                                    </div>
                                                    </li>
                                                </ul>
                                               
                                            </div>
                          </div>
                    
                                            
       ";
        }
    }
}



SELECT * FROM posts
    INNER JOIN users ON
    posts.user_id=users.user_id
    INNER JOIN preference ON
    preference.user_id=users.user_id
    INNER JOIN tags ON
    tags.post_id=posts.post_id
    WHERE preference.tag_name Like '%#hotel%' OR preference.location Like '%LA%'







