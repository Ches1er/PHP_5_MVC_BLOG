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

<!-- Error -->

<div class="error">
    <?php if (isset($error)): ?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

<!-- Container -->

<div class="container">

    <!-- Aside -->

    <aside>
        <ul class="category_menu">
            <li><a href="/showcat/all"</a>All</li>
            <?php foreach ($menu_cat as $cat): ?>
                <li><a href="/showcat/<?= $cat->category_url ?>"><?= $cat->category_name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- All Posts -->

    <article class="all_posts">
        <!--<div class="sort">Сортировка по дате:
                <a href="/main/sort/desc">сначала старые  </a>
                <a href="/main/sort/asc">сначала новые</a>
        </div>-->
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="main_post">
                    <div class="text">
                        <div class="post_name"><a href="\post\<?= $post->post_id ?>"><?= $post->post_name ?></a></div>
                        <div class="post_author">Author: <?= $post->author()->login ?></div>
                        <div class="post_data"><?= date('d-m-y h:m:s',$post->data)?></div>
                        <div class="post_desc"><?= $post->post_desc ?></div>
                        <div class="post_comment_amount">Number of comments: <?= $post->hasAmountComments() ?></div>
                    </div>
                    <div class="upic"><img class="large_avatar" src="/<?= $post->author()->getPicture()->path ?>"
                                           alt=""></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="pagination">
            <?php for ($i = 0, $j = 1; $i < $number_of_posts; $i += $posts_per_page, $j++): ?>
                <a href="/?page=<?= $j ?>"><?= $j ?></a>
            <?php endfor; ?>
        </div>
    </article>
</div>
