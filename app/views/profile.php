<h1>Profile</h1>
<h2>Загрузите картинку</h2>
<form enctype="multipart/form-data" action="/addpic" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Выберите картинку: <input name="userfile" type="file" />
    <input type="submit" value="Добавить картинку" />
</form>
<h2>Смените подпись</h2>
<form action="\changesign" method="post">
    <input type="text" name="sign">
    <input type="submit" value="Change">
</form>