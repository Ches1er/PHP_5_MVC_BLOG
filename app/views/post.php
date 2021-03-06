<!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):?>
            <?php if (in_array("admin", $user_roles)):?>
                <li><a href="/admin">Admin</a></li>
                <li><a href="/profile">User Profile</a></li>
                <li><a href="/myposts">My Posts</a></li>
            <?php elseif (in_array("user", $user_roles))  : ?>
                <li><a href="/profile">User Profile</a></li>
                <li><a href="/myposts">My Posts</a></li>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (is_null($user)): ?>
            <li><a href="/main/register">Sign Up</a></li>
            <li><a href="/main/login">Sign In</a></li>
        <?php endif; ?>
        <?php if (!is_null($user)&& empty($user_roles)): ?>
            <li><a href="/profile">User Profile</a></li>
        <?php endif; ?>
        <?php if (!is_null($user)): ?>
            <li><a href="/main/logout">Logout</a></li>
        <?php endif; ?>

    </ul>


    <!-- Activ user -->

    <div class="activ_user">
        <?php if (!is_null($user)): ?>
            <div class="cur_user_name"><?= "Current user: " . $user->login ?></div>
            <div class="cur_user_img">
                <img class="small_avatar" src="<?= "/" . $user->getPicture()->path ?>" alt="">
            </div>
        <?php else: ?>
            <div class="cur_user_name"><?= "Current user: none" ?></div>
            <div class="cur_user_img">
                <img class="small_avatar" src="/img/inactive.png" alt="">
            </div>
        <?php endif; ?>
    </div>

</nav>

    <!-- Article-->

<div class="post_container">
<div class="full_post">
    <div class="text">
        <div class="post_name"><a href="\post\<?=$post->post_id?>"><?=$post->post_name?></a></div>
        <div class="post_author">Author: <?=$post->author()->login?></div>
        <div class="post_data"><?=date('d-m-y h:m:s',$post->data)?></div>
        <div class="post_full"><?=$post->post_full?></div>
    </div>
    <div class="upic"><img class="large_avatar" src="/<?=$post->author()->getPicture()->path?>" alt=""></div>
</div>
<hr>
<div class="comments">
    <h2>Комментарии пользователей</h2>
    <?php foreach ($comments as $comment):?>
        <div class="comment">
            <div class="comment_desc"><?=$comment->author()->login." : ".$comment->comment_desc?></div>
            <?php if (!is_null($user_roles) && in_array("admin",$user_roles)):?>
            <a href="commentdel/<?=$comment->comment_id?>" class="comment_delete">X</a>
            <?php endif;?>
        </div>
    <?php endforeach;?>
</div>


<div class="comment_new">
    <hr>
    <h2>Оставить комментарий к статье</h2>
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
</div>
