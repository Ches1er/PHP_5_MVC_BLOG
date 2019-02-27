<h1>Author</h1>
<div class="categories">
    <div class="all_categories">
        <h2>All posts</h2>
        <?php if (!empty($posts)):
        foreach ($posts as $post):?>
            <p><?php echo $post->post_name?></p>
            <p><?php echo $post->data?></p>
            <p><?php echo $post->post_desc?></p>
        <?php endforeach;
        endif;?>
    </div>
    <div class="add_new_category">
        <h2>Add new post</h2>
        <form action="/myposts/addpost" method="post">
            <input type="text" name="post_name">
            <textarea name="post_full" id="" cols="30" rows="5"></textarea>
            <select name="category_name" id="">
                <?php foreach ($categories as $category): var_dump($categories)?>
                <option value="<?= $category->category_id?>"><?= $category->category_name?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" name="Add post">
        </form>
    </div>
</div>