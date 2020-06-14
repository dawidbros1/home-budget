<?php $_SESSION['title'] = "Lista kategorii"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Lista kategorii</h1>

<?php showCustomSessionValue('category:info', 'green', '28', 'center') ?>

<?php
$categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();

if ($categories) {
    echo '<form class="px-4 py-3 col-md-12" action="./index.php?action=editCategory" method="post">';
    echo '<div class = "flex">';
    foreach ($categories as $category) {

        echo '
        <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Nazwa kategorii</label>
            <input type="text" class="form-control" name="name[]" value = "' . $category->getName() . '">
            <input type = "hidden" name = "id[]" value = ' . $category->getId() . ' >
        </div>
    ';
    }

    echo '</div>';
    echo ' <button type="submit" class="btn btn-primary">Edytuj kategorie</button>';
    echo '</form>';
}
?>





<?php require_once __DIR__ . './../footer.php'; ?>