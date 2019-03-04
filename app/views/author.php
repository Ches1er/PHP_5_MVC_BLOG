<!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):
            if (in_array("admin", $user_roles)):?>
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
        <?php else: ?>
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

<!-- Error -->

<div class="error">
    <?php if (isset($error)):?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

<!-- Container -->

<h1>Мои посты</h1>
<article class="my_posts">
        <?php if (!empty($posts)):?>
            <?php foreach ($posts as $post):?>
    <div class="main_post">
        <div class="text">
            <div class="post_name"><a href="\post\<?=$post->post_id?>"><?=$post->post_name?></a></div>
            <div class="post_data"><?=$post->data?></div>
            <div class="post_desc"><?=$post->post_desc?></div>
            <a href="/myposts/delpost/<?=$post->post_id?>">delete post</a>
        </div>
    </div>
        <?php endforeach;
        endif;?>

    <div class="add_new_post">
        <h2>Add new post</h2>
        <form action="/myposts/addpost" method="post">
            Введите тему поста:<input class="addpost_postname" type="text" name="post_name">
            Введите пост:
            <textarea name="post_full" id="" cols="30" rows="5"></textarea>
            Выберите категорию:<select name="category_name" id="">
                <?php foreach ($categories as $category): var_dump($categories)?>
                <option value="<?= $category->category_id?>"><?= $category->category_name?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" name="Add post" value="Опубликовать">
        </form>
    </div>
</div>
</article>