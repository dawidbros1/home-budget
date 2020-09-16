<?php $_SESSION['title'] = "Rejestracja"; ?>
<?php require_once __DIR__ . './../header.php'; ?>

<div class="px-4 py-3">
    <h1>Rejestracja</h1>

    <form action="./index.php?action=register" method="post">

        <div class="form-group">
            <label for="exampleInputEmail1">Adres e-mail</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <?php showErrorSessionValue('error:register:email:unique') ?>
        <?php showErrorSessionValue('error:register:email:validate') ?>

        <div class="form-group">
            <label for="exampleInputPassword1">Hasło (od 5 do 16 znaków) </label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>

        <?php showErrorSessionValue('error:register:password:length') ?>

        <div class="form-group">
            <label for="exampleInputPassword1">Powtórz hasło</label>
            <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1">
        </div>

        <?php showErrorSessionValue('error:register:password:unique') ?>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="checkbox" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Akceptuję regulamin</label>
        </div>

        <?php showErrorSessionValue('error:register:regulations') ?>

        <button type="submit" class="btn btn-primary">Zarejestruj</button>

    </form>
</div>

<div class="pb-3">
    <a class="dropdown-item" href="index.php?action=login">Posiadasz już konto? <span class="green bold">Zaloguj się</span></a>
</div>

<?php require_once __DIR__ . './../footer.php'; ?>