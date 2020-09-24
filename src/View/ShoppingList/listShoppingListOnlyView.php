<?php $_SESSION['title'] = "Lista produkt"; ?>
<?php $_SESSION['css'] =  "listShoppingOnlyView" ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Lista zakupów</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Ilośc</th>
                    <th scope="col">Cena</th>
                </tr>
            </thead>
            <tbody id="shoppingList">

            </tbody>
        </table>

    <?php $today = date_format(new DateTime(), 'Y-m-d'); ?>
    <input type="date" id="date" value="<?php echo $today ?>">

</div>

<?php $_SESSION['js'] =  ["dataFilterShoppingListOnlyView"]; ?>
<?php require_once __DIR__ . './../footer.php'; ?>