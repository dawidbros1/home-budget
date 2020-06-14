var date = document.getElementsByClassName('date');
var deleteStatus = document.getElementsByClassName('delete');
var price = document.getElementsByClassName('price');
var product_id = document.getElementsByClassName('product_id')
var amount = document.getElementsByClassName('amount');
var discount = document.getElementsByClassName('discount');
var id = document.getElementsByClassName('id');
var edited = document.getElementsByClassName('edited');


for (var i = 0; i < date.length; i++) {
    (function (i) {
        date[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        deleteStatus[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        price[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        amount[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        discount[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);

        product_id[i].addEventListener('change', function (event) {
            edited[i].value = 1;
        }, false);
    })(i);
}

// Przygotowanie formularza z edytowanymi danymi
var button = document.getElementById('editShopppingList');
var inputsForm = document.getElementById('jsForm');
var formButton;

button.addEventListener('click', function () {
    for (var i = 0; i < edited.length; i++) {
        if (edited[i].value == 1) {
            addPositionToForm(i);
        }
    }

    formButton = document.getElementById('formButton');
    formButton.click();
})

function addPositionToForm(i) {
    html = '';
    html += ' <input type="date" name="date[]" value = "' + date[i].value + '">';
    html += ' <input type="number" name="product_id[]" value = "' + product_id[i].value + '">';


    if (deleteStatus[i].checked == true) {
        html += ' <input type="number" name="delete[]" value = "1">';
    }
    else {
        html += ' <input type="number" name="delete[]" value = "0">';
    }

    html += ' <input type="number" name="price[]" step = "0.01"  value = "' + price[i].value + '">';
    html += ' <input type="number" name="amount[]" step = "0.001"  value = "' + amount[i].value + '">';
    html += ' <input type="number" name="discount[]" step = "0.01"  value = "' + discount[i].value + '">';
    html += ' <input type="hidden" name="id[]" value = "' + id[i].value + '">';

    inputsForm.innerHTML += html;
}