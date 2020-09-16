<?php
$_SESSION['title'] = "Podsumowanie"; ?>
<?php $_SESSION['js'] =  ["summaryFilter"]; ?>
<?php $_SESSION['css'] =  "summary"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">

    <h1>Podsumowanie</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Produkt</th>
                <th scope="col">Cena</th>
                <th scope="col">Ilośc</th>
                <th scope="col">Suma</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $fullSummary = 0;

            $categories = \App\Repository\CategoryRepository::getAllCategoriesForCurrentUser();

            if ($categories) {
                foreach ($categories as $category) {

                    $categorySummary = 0;

                    echo '
            <tr>
                <td></td>
                <td colspan="4" class="bold">' . $category->getName() . ' </td>
            </tr>';

                    $products = \App\Repository\ProductRepository::getAllProductsByCategoryId($category->getId());

                    if ($products) {
                        $counter = 1;

                        foreach ($products as $product) {
                            $shopList = \App\Repository\ShoppingListRepository::getAllShoppingListByProductId($product->getId());
                            if ($shopList) {
                                $discount = 0;
                                $summary = 0;
                                $amount = 0;

                                foreach ($shopList as $singleShopList) {
                                    $summary += $singleShopList->getPrice() * $singleShopList->getAmount() - $singleShopList->getDiscount();
                                    $amount += $singleShopList->getAmount();
                                }

                                $price = ($summary / $amount);
                                $categorySummary = $categorySummary + $summary;

                                echo '
                                <tr>
                                    <td>' . $counter++ . '</td>
                                    <td>' . $product->getName() . '</td>
                                    <td>' . number_format((float) $price, 2, '.', '') . ' zł</td>
                                    <td>' . $amount . '</td>
                                    <td>' . number_format((float) $summary, 2, '.', '') . ' zł</td>
                                </tr>
                            ';
                            }
                        }
                    }

                    $fullSummary += $categorySummary;


                    echo '
                <tr>
                <td colspan="4"></td>
                <td class = "text-right">Suma: ' . number_format((float) $categorySummary, 2, '.', '') . ' zł</td>
                </tr>
                ';
                }
                echo '
            <tr>
            <td colspan="4"></td>
            <td class = "text-right">Całkowity koszt: ' . number_format((float) $fullSummary, 2, '.', '') . ' zł</td>
            </tr>
            ';
            }



            ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>