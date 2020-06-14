<?php

use App\Repository\ShoppingListRepository;

$_SESSION['title'] = "Podsumowanie"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<?php $_SESSION['js'] =  ["summaryFilter"]; ?>

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

                        if (
                            isset($_REQUEST['year']) && !empty($_REQUEST['year']) &&
                            isset($_REQUEST['month']) && !empty($_REQUEST['month'])
                        ) {
                            $shopList = \App\Repository\ShoppingListRepository::getAllShoppingListByProductIdWithDate($product->getId(), $_REQUEST['year'], $_REQUEST['month']);
                        } else {
                            $shopList = \App\Repository\ShoppingListRepository::getAllShoppingListByProductId($product->getId());
                        }

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

<form id="dataBoxForm" class="flex" method="post" action="./index.php?action=summary">
    <div class="fallbackDatePicker">
        <div></div>
        <span>
            <label for="month">Month:</label>
            <select id="month" name="month">

                <?php
                $now = new DateTime();
                $month = date_format(new DateTime(), 'm');
                $year = date_format(new DateTime(), 'Y');


                function selectMonth($value)
                {
                    global $month;
                    if ($value == $month) {
                        echo 'selected';
                    }
                }

                function selectYear($value)
                {
                    global $year;
                    if ($value == $year) {
                        echo 'selected';
                    }
                }

                ?>

                <option <?php selectMonth(1) ?> value="1"> Styczeń</option>
                <option <?php selectMonth(2) ?> value="2"> Luty</option>
                <option <?php selectMonth(3) ?> value="3"> Marzec</option>
                <option <?php selectMonth(4) ?> value="4"> Kwiecień</option>
                <option <?php selectMonth(5) ?> value="5"> Maj</option>
                <option <?php selectMonth(6) ?> value="6"> Czerwiec</option>
                <option <?php selectMonth(7) ?> value="7"> Lipiec</option>
                <option <?php selectMonth(8) ?> value="8"> Sierpień</option>
                <option <?php selectMonth(9) ?> value="9"> Wrzesień</option>
                <option <?php selectMonth(10) ?> value="10"> Październik</option>
                <option <?php selectMonth(11) ?> value="11"> Listopad</option>
                <option <?php selectMonth(12) ?> value="12"> Grudzień</option>
            </select>
        </span>
        <span>
            <label for="year">Year:</label>
            <select id="year" name="year">
                <?php
                $minDate = \App\Repository\ShoppingListRepository::getMinDate();

                if ($minDate) {
                    $nowYear = date_format(new DateTime(), 'Y');

                    while ($minDate <= $nowYear) {

                        if ($minDate == $nowYear) {
                            echo '<option selected value="' . $minDate . '">' . $minDate . '</option>';
                        } else {
                            echo '<option value="' . $minDate . '">' . $minDate . '</option>';
                        }

                        $minDate++;
                    }
                } else {
                    echo '<option>Brak</option>';
                }

                ?>
            </select>
        </span>
    </div>

    <button type="submit" id="button">aktualizuj</button>

</form>

<?php require_once __DIR__ . './../footer.php'; ?>