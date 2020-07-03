var button = document.getElementById('editProductListButton');

button.addEventListener('click', function () {
    sendProductsList();
})

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

function sendProductsList() {
    var name = document.getElementsByClassName('editProductName');
    var price = document.getElementsByClassName('editPrice');
    var id = document.getElementsByClassName('id');
    var edited = document.getElementsByClassName('edited');
    var category_id = document.getElementsByClassName('editOptions');

    var inputsForm = document.getElementById('jsForm');

    var formButton;

    for (var i = 0; i < edited.length; i++) {
        if (edited[i].value == 1) {
            addPositionToForm(i);
        }
    }

    formButton = document.getElementById('formButton');
    formButton.click();

    function addPositionToForm(i) {
        html = '';
        html += ' <input type="text" name="name[]" value = "' + name[i].value + '">';
        html += ' <input type="number" name="price[]" step = "0.01"  value = "' + price[i].value + '">';
        html += ' <input type="number" name = "category_id[]" value = "' + category_id[i].value + '">';
        html += ' <input type="hidden" name="id[]" value = "' + id[i].value + '">';

        inputsForm.innerHTML += html;
    }
}