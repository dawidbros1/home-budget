<?php $_SESSION['title'] = "Lista produkt"; ?>

<?php $_SESSION['css'] =  "listShoppingOnlyView" ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Lista zakupów</h1>

<div id="shoppingList">

    <?php $today = date_format(new DateTime(), 'Y-m-d'); ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Ilośc</th>
                <th scope="col">Cena</th>
            </tr>
        </thead>
        <tbody id="shopppingList">

            <?php
            $shoppingList = \App\Repository\ShoppingListRepository::getAllShoppingListForCurrentUserWithFullDate($today);

            if ($shoppingList) {
                foreach ($shoppingList as $key => $singleShoppingList) {
                    echo '
                        <tr>
                            <th scope="row">' . ($key + 1) . '</th>
                            <td>' . \App\Repository\ProductRepository::getProductById($singleShoppingList->getProduct_id())[0]->getName() . '</td>
                            <td>' . $singleShoppingList->getAmount() . '</td>
                            <td>' . $singleShoppingList->getPrice() . '</td>
                        </tr>
                    ';
                }
            }

            ?>
        </tbody>
    </table>

    <input type="date" id="date" value="<?php echo $today ?>">
</div>

<?php $_SESSION['js'] =  ["dataFilterShoppingListOnlyView"]; ?>

<?php require_once __DIR__ . './../footer.php'; ?>