<?php $_SESSION['title'] = "Dodaj kategorie"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Dodaj kategorię</h1>

    <?php showSessionActionValueWithColor('category:info', 'green') ?>

    <form action="./index.php?action=addCategory" method="post">

        <div class="form-group">
            <label for="exampleInputEmail1">Nazwa kategorii</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
    </form>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>