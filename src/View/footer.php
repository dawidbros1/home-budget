<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<footer>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link" href="./index.php?action=regulations">Regulamin</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="./index.php?action=privacy_policy">Polityka prywatności</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="./index.php?action=contact">Kontakt</a>
            </li>
        </ul>
    </nav>
</footer>


</div>

<?php if (isset($_SESSION['js'])) {

    $jsNames = $_SESSION['js'];

    foreach ($_SESSION['js'] as $jsName) {
        echo '<script src = js/' . $jsName . '.js></script>';
    }

    unset($_SESSION['js']);
} ?>


</body>

</html>