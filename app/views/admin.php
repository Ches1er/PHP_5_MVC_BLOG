<h1>admin</h1>
<div class="categories">
    <div class="all_categories">
        <h2>All categories</h2>
        <?php foreach ($categories as $category):?>
        <p><?php echo $category->category_name?></p>
        <?php endforeach;?>
    </div>
    <div class="add_new_category">
    <h2>Add new category</h2>
    <form action="/admin/addcategory" method="post">
        <input type="text" name="category_name">
        <input type="submit" name="Add category">
    </form>
    </div>
</div>