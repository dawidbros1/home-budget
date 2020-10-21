<?php $_SESSION['title'] = "Lista kategorii"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Lista kategorii</h1>

    <?php showSessionActionValueWithColor('category:info', 'green') ?>

    <?php
    $categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();

    if ($categories) {
        echo '<form col-md-12" action="./index.php?action=editCategory" method="post">';
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
</div>

<?php require_once __DIR__ . './../footer.php'; ?>