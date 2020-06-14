<?php $_SESSION['title'] = "Lista produkt"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Lista zakupów</h1>

<form class="px-4 py-3 relative" action="./index.php?action=editShoppingList" method="post">
    <div id="shoppingList">

        <?php
        $shoppingList = \App\Repository\ShoppingListRepository::getAllShoppingListForCurrentUser();

        echo '<div class = "flex">';

        if ($shoppingList) {
            foreach ($shoppingList as $singleShoppingList) {
                echo '
                <div class = "dataBox flex col-12">
                <hr>
                    <div class="form-group col-md-6">
                        <label>Produkt</label>
                        <select class="form-control product_id" name="product_id[]">';

                echo getOptions($singleShoppingList->getProduct_id());

                echo '  </select>
                    </div>
                    
                    <div class="form-group col-md-5">
                        <label>Data</label>
                        <input type="date" class="form-control time date" name="date[]" value = "' . $singleShoppingList->getDate() . '">
                    </div>

                    <div class="form-group col-md-1 relative text-center">
                        <label>Usuń</label>
                        <div class="form-check">    
                            <input class="form-check-input position-static delete" type="checkBox" name="delete">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Cena</label>
                        <input type="number" step="0.01" class="form-control price" name="price[]" value = "' . $singleShoppingList->getPrice() . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Ilośc</label>
                        <input type="number" step="0.001" class="form-control amount" name="amount[]" value = "' . $singleShoppingList->getAmount() . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Rabat</label>
                        <input type="number" step="0.01" class="form-control discount" name="discount[]" value = "' . $singleShoppingList->getDiscount() . '">
                    </div>

                <input type = "hidden" class = "id" name = "id[]" value = ' . $singleShoppingList->getId() . '>
                <input class = "edited" type = "hidden" name = "edited[] value = "0">
                </div>
                ';
            }
            echo '<hr>';
            echo '</div>';
            echo ' <button type="button" class="btn btn-primary" id = "editShopppingList">Edytuj zakupy</button>';
        }

        ?>

        <?php

        function select($shopLift_product_id, $product_id)
        {
            if ($shopLift_product_id == $product_id) {
                return 'selected';
            }
        }

        function getOptions($shopLift_product_id)
        {
            $products = \App\Repository\ProductRepository::getAllProductsForCurrentUser();

            foreach ($products as $product) {
                echo '<option ' . select($shopLift_product_id, $product->getId()) . ' value = ' . $product->getId() . '>' . $product->getName() . '</option>';
            }
        }

        ?>

        <?php
        $today = date_format(new DateTime(), 'Y-m-d');
        ?>

        <input type="date" id="date" value="<?php echo $today ?>">

    </div>
</form>


<form action="./index.php?action=editShoppingList" method="post" id="jsForm" style="display:none">
    <input type="submit" style="display: none" id="formButton">
</form>


<?php $_SESSION['js'] =  ["dataFilterListShoppingList", "checkEditShoppingList"]; ?>

<?php require_once __DIR__ . './../footer.php'; ?>