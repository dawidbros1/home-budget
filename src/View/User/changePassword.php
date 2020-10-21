<?php $_SESSION['title'] = "Zmiana hasła"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Zmiana hasła</h1>
    <?php showSessionActionValueWithColor('info', 'green') ?>
    <form action="./index.php?action=changePassword" method="post">

        <div class="form-group">
            <label>Stare hasło</label>
            <input type="password" class="form-control" name="password_old">
        </div>

        <?php showErrorSessionValue('error:changePassword:password:old') ?>

        <?php showErrorSessionValue('error:changePassword:password:same') ?>

        <div class="form-group">
            <label>Nowe Hasło (od 5 do 16 znaków) </label>
            <input type="password" class="form-control" name="password_new">
        </div>

        <?php showErrorSessionValue('error:changePassword:password:length') ?>

        <div class="form-group">
            <label>Powtórz nowe hasło</label>
            <input type="password" class="form-control" name="password_confirm_new">
        </div>

        <?php showErrorSessionValue('error:changePassword:password:unique') ?>

        <button type="submit" class="btn btn-primary">Zmień hasło</button>

    </form>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>