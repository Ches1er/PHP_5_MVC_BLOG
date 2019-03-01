
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
                <img class="small_avatar" src="<?="/".$user->getPicture()->path?>" alt="">
            </div>
        <?php else:?>
            <div class="cur_user_name"><?="Current user: none"?></div>
            <div class="cur_user_img">
                <img class="small_avatar" src="/img/inactive.png" alt="">
            </div>
        <?php endif;?>
    </div>

</nav>

    <!-- Article-->


<div class="full_post">
    <div class="text">
        <div class="post_name"><a href="\post\<?=$post->post_id?>"><?=$post->post_name?></a></div>
        <div class="post_author">Author: <?=$post->author()->login?></div>
        <div class="post_data"><?=$post->data?></div>
        <div class="post_full"><?=$post->post_full?></div>
    </div>
    <div class="upic"><img class="large_avatar" src="/<?=$post->author()->getPicture()->path?>" alt=""></div>
</div>
<hr>
<div class="comments">
    <?php foreach ($comments as $comment):?>
        <div class="comment">
            <div class="comment_desc"><?=$comment->author()->login." : ".$comment->comment_desc?></div>
            <div class="comment_author"></div>
        </div>
    <?php endforeach;?>
</div>

<div class="comment_new">
<form  action="/comment/new" method="post">
    <textarea name="comment" id="" cols="30" rows="5"></textarea>
    <input type="hidden" name="post_id" value="<?=$post_id?>">
    <?php if (!is_null($user)): ?>
        <input type="submit">
    <?php else:?>
        <input type="submit" disabled="disabled">
        <div class="comment_error">Для того, чтобы оставлять комментарии,
            <a href="/main/login">войдите</a> на сайт или
            <a href="/main/register">зарегистрируйтесь.</a>
        </div>
    <?php endif;?>
</form>
</div>
