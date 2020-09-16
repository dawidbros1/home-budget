<?php $_SESSION['title'] = "Dodaj produkt"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Dodaj produkt</h1>

    <form action="./index.php?action=addProduct" method="post">
        <div class="form-group">
            <label for="inputAddress">Nazwa produktu</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-row">

            <div class="form-group col-md-10">
                <label>Kategoria</label>
                <select class="form-control" name="category_id">

                    <?php

                    $categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();

                    foreach ($categories as $category) {
                        echo '<option value = ' . $category->getId() . '>' . $category->getName() . '</option>';
                    }

                    ?>

                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Cena</label>
                <input type="number" step=0.01 class="form-control" name="price" value="0.00">
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Dodaj produkt</button>
    </form>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>