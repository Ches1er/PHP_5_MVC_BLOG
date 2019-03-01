
    <!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):
                  foreach ($user_roles as $role):
                  if ($role==="admin"):?>
                     <li><a href="/admin">Admin</a></li>
                      <li><a href="/profile">User Profile</a></li>
                      <li><a href="/myposts">My Posts</a></li>
                  <?php elseif ($role==="user")  :?>
                      <li><a href="/profile">User Profile</a></li>
                      <li><a href="/myposts">My Posts</a></li>
                  <?php endif; ?>
                  <?php endforeach;?>
                  <?php endif;?>

                    <?php if (is_null($user)):?>
                        <li><a href="/main/register">Sign Up</a></li>
                        <li><a href="/main/login">Sign In</a></li>
                    <?php else:?>
                        <li><a href="/main/logout">Logout</a></li>
                <?php endif;?>

    </ul>


    <!-- Activ user -->

<div class="activ_user">
            <?php if (!is_null($user)):?>
                <div class="cur_user_name"><?= "Current user: ".$user->login?></div>
                <div class="cur_user_img">
                    <img class="small_avatar" src="<?=$user->getPicture()->path?>" alt="">
                </div>
            <?php else:?>
                <div class="cur_user_name"><?="Current user: none"?></div>
                <div class="cur_user_img">
                    <img class="small_avatar" src="/public/img/inactive.png" alt="">
                </div>
            <?php endif;?>
        </div>

</nav>

    <!-- Error -->

<div class="error">
    <?php if (isset($error)):?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

    <!-- Container -->

<div class="container">

    <!-- Aside -->

<aside>
    <ul class="category_menu">
        <?php foreach ($menu_cat as $cat):?>
            <li><a href="/showcat/<?=$cat->category_url?>"><?=$cat->category_name?></a></li>
        <?php endforeach;?>
    </ul>
</aside>

<!-- All Posts -->

<article>
    <?php if (!empty($posts)):?>
        <?php foreach ($posts as $post):?>
            <div class="main_post">
                <div class="text">
                    <div class="post_name"><a href="\post\<?=$post->post_id?>"><?=$post->post_name?></a></div>
                    <div class="post_author">Author: <?=$post->author()->login?></div>
                    <div class="post_data"><?=$post->data?></div>
                    <div class="post_desc"><?=$post->post_desc?></div>
                    <div class="post_comment_amount">Number of comments: <?=$post->hasAmountComments()?></div>
                </div>
                <div class="upic"><img class="large_avatar" src="/<?=$post->author()->getPicture()->path?>" alt=""></div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="pagination">
            <?php for($i=0,$j=1;$i<$number_of_posts;$i+=$posts_per_page,$j++):?>
                <a href="/?page=<?=$j?>"><?=$j?></a>
            <?php endfor;?>
    </div>
</article>
</div>
