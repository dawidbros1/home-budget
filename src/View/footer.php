<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<footer class="page-footer bg-dark">
    <div class="footer-copyright text-center py-3">
        <a href="./index.php?action=regulations">Regulamin</a>
        <a href="./index.php?action=contact">Kontakt</a>
    </div>
</footer>
</div>
</div>


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