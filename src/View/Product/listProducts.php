<?php $_SESSION['title'] = "Lista produktów"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Lista produktów</h1>

<?php showCustomSessionValue('category:info', 'green', '28', 'center') ?>

<?php
$products = \App\Repository\ProductRepository::getAllProductsForCurrentUser();

if ($products) {
    $categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();
    echo '<form class="px-4 py-3 col-md-12" action="./index.php?action=editProduct" method="post">';
    echo '<div class = "flex">';

    foreach ($products as $product) {
        echo '
            <div class="form-group col-md-5">
                <label for="exampleInputEmail1">Nazwa produktu</label>
                <input type="text" class="form-control editProductName" name="name[]" value = "' . $product->getName() . '">
                <input type = "hidden" class = "id" name = "id[]" value = ' . $product->getId() . ' >
            </div>

            <div class="form-group col-md-5">
            <label>Kategoria</label>
            <select class="form-control editOptions" name="category_id[]">';

        echo getOptions($product->getCategory_id());

        echo '</select>
            </div>

            <div class="form-group col-md-2">
                <label>Cena</label>
                <input type="number" step=0.01 class="form-control editPrice" name="price[]" value = ' . $product->getPrice() . '>
            </div>

            <input class = "edited" type = "hidden" name = "edited[]" value = "0">
        ';
    }

    echo '</div>';
    echo ' <button type="button" class="btn btn-primary" id = "editProductListButton">Edytuj produkty</button>';
    echo '</form>';
}

?>

<form action="./index.php?action=editProduct" method="post" id="jsForm" style="display:none">
    <input type="submit" style="display: none" id="formButton">
</form>

<?php

function select($product_category_id, $category_id)
{
    if ($product_category_id == $category_id) {
        return 'selected';
    }
}

function getOptions($product_category_id)
{
    $categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();

    foreach ($categories as $category) {
        echo '<option ' . select($product_category_id, $category->getId()) . ' value = ' . $category->getId() . '>' . $category->getName() . '</option>';
    }
}


?>

<?php $_SESSION['js'] = ['checkEditProductsList'] ?>

<?php require_once __DIR__ . './../footer.php'; ?>