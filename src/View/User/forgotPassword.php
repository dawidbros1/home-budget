<?php $_SESSION['title'] = "Przypomnienie hasła"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Przypomnienie hasła</h1>
    <?php showSessionActionValueWithColor('forgotPassword:email:correct', 'green') ?>

    <form action="./index.php?action=forgotPassword" method="post">

        <div class="form-group">
            <label>Podaj adres email: </label>
            <input type="email" class="form-control" name="email">
        </div>

        <?php showErrorSessionValue('error:forgotPassword:email') ?>

        <button type="submit" class="btn btn-primary">Przypomnij hasło</button>
    </form>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>