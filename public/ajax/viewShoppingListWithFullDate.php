<?php

require_once __DIR__ . './dataInit.php';

$date = $_REQUEST['date'];

// TODO Sprawdzenie czy format daty jest ok

$shoppingList = \App\Repository\ShoppingListRepository::getAllShoppingListForCurrentUserWithFullDate($date);

if ($shoppingList != NULL && $shoppingList != false) {
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

    echo $date;
}
