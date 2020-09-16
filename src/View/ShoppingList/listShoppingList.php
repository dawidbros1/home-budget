<?php $_SESSION['title'] = "Lista produkt"; ?>
<?php $_SESSION['css'] =  "listShopping" ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Lista zakupów</h1>

    <div>
        <form class="relative" action="./index.php?action=editShoppingList" method="post">
            <div id="shoppingList">

            </div>

            <button type="button" class="btn btn-primary" id="editShopppingList">Edytuj zakupy</button>

            <?php
            $today = date_format(new DateTime(), 'Y-m-d');
            ?>

            <input type="date" id="date" value="<?php echo $today ?>">
        </form>

        <form action="./index.php?action=editShoppingList" method="post" id="jsForm" style="display:none">
            <input type="submit" style="display: none" id="formButton">
        </form>
    </div>
</div>

<?php $_SESSION['js'] =  ["checkEditShoppingList", "dataFilterListShoppingList"] ?>
<?php require_once __DIR__ . './../footer.php'; ?>