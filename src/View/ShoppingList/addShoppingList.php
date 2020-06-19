<?php $_SESSION['title'] = "Dodaj zakupy"; ?>

<?php $_SESSION['css'] =  "addShoppingList"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Dodaj zakup</h1>

<form class="px-4 py-3 relative" action="./index.php?action=addShoppingList" method="post">
    <div id="shoppinglist">

    </div>

    <div class="text-center" id="addPosition">Dodaj pozycję</div>

    <button type="submit" class="btn btn-primary">Wyślij zakupy</button>

    <?php
    $date = date_format(new DateTime(), 'Y-m-d');
    ?>

    <input type="date" name="date" id="date" value="<?php echo $date ?>">

    <?php
    $products = \App\Repository\ProductRepository::getAllProductsForCurrentUser();
    $names = [];
    $ids = [];
    $prices = [];

    if ($products) {
        for ($i = 0; $i < count($products); $i++) {
            array_push($names, $products[$i]->getName());
            array_push($ids, $products[$i]->getId());
            array_push($prices, $products[$i]->getPrice());
        }
    }
    ?>

    <script>
        var prices = <?php echo json_encode($prices) ?>;
        var names = <?php echo json_encode($names) ?>;
        var ids = <?php echo json_encode($ids) ?>;
    </script>

</form>

<?php $_SESSION['js'] =  ["main"]; ?>

<?php require_once __DIR__ . './../footer.php'; ?>