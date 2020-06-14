var editProductName = document.getElementsByClassName('editProductName');
var editPrice = document.getElementsByClassName('editPrice');
var editOptions = document.getElementsByClassName('editOptions');
var edited = document.getElementsByClassName('edited');


for (var i = 0; i < editProductName.length; i++) {
    (function (i) {
        editProductName[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        editPrice[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        editOptions[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);
    })(i);
}
