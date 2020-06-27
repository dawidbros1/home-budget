<?php

require_once __DIR__ . './dataInit.php';

$date = $_REQUEST['date'];

$shoppingList = \App\Repository\ShoppingListRepository::getAllShoppingListForCurrentUserWithFullDate($date);

$sum = 0;

if ($shoppingList) {
    foreach ($shoppingList as $key => $singleShoppingList) {

        $price = $singleShoppingList->getPrice() * $singleShoppingList->getAmount() - $singleShoppingList->getDiscount();
        $sum += $price;
        echo '
            <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . \App\Repository\ProductRepository::getProductById($singleShoppingList->getProduct_id())[0]->getName() . '</td>
                <td>' . $singleShoppingList->getAmount() . '</td>
                <td>' .  number_format((float) $price, 2, '.', '') . ' zł</td>
            </tr>
        ';
    }

    echo '
        <tr>
            <td colspan="3"></td>
            <td class = "text-right">Całkowity koszt: ' . number_format((float) $sum, 2, '.', '') . ' zł</td>
        </tr>
        ';
}
