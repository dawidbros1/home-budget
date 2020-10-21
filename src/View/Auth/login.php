<?php $_SESSION['title'] = "Logowanie"; ?>
<?php require_once __DIR__ . '/../header.php'; ?>

<div class="px-4 py-3">

    <h1>Logowanie</h1>

    <?php showSessionActionValueWithColor('register:new:account:info', 'green') ?>

    <form action="./index.php?action=login" method="post">


        <div class="form-group">
            <label for="exampleDropdownFormEmail1">Adres e-mail</label>
            <input type="email" class="form-control" name="email" id="exampleDropdownFormEmail1" placeholder="email@example.com" value="<?php showSessionValue('login:email:value') ?>">
        </div>

        <?php showErrorSessionValue('error:login:email') ?>

        <div class="form-group">
            <label for="exampleDropdownFormPassword1">Hasło</label>
            <input type="password" class="form-control" name="password" id="exampleDropdownFormPassword1" placeholder="Password">
        </div>

        <?php showErrorSessionValue('error:login:password') ?>

        <button type="submit" class="btn btn-primary">Zaloguj się</button>
    </form>
</div>

<div class="pb-3">
    <a class="dropdown-item" href="index.php?action=register">Jesteś tu nowy? <span class="green bold">Załóż konto</span></a>
    <a class="dropdown-item" href="index.php?action=forgotPassword">Zapomniałeś hasła?</a>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>