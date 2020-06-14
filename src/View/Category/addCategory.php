<?php $_SESSION['title'] = "Dodaj kategorie"; ?>

<?php require_once __DIR__ . './../header.php'; ?>

<h1>Dodaj kategorię</h1>

<?php showCustomSessionValue('category:info', 'green', '28', 'center') ?>

<form class="px-4 py-3" action="./index.php?action=addCategory" method="post">

    <div class="form-group">
        <label for="exampleInputEmail1">Nazwa kategorii</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>

    <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
</form>

<?php require_once __DIR__ . './../footer.php'; ?>