var button = document.getElementById('addPosition');
var counter = 0;

class shopList {
    constructor(id, price, amount, discount) {
        this.id = id;
        this.price = price;
        this.amount = amount;
        this.discount = discount;
    }
}

var shopListItems = new Array();

function getSelectBox() {
    var selectBox = '';

    selectBox += '<select class="form-control selectBox" name="product_id[]">';
    selectBox += '<option selected>Choose...</option>';

    for (var i = 0; i < names.length; i++) {
        selectBox += '<option class = "optionsFields" value = ' + ids[i] + '>' + names[i] + '</option>';
    }

    selectBox += '</select>';

    return selectBox;
}

selectBox = getSelectBox();

button.addEventListener('click', function () {
    html = document.getElementById('shoppinglist').innerHTML;
    html += '<div class="form-row">';
    html += '<div class="form-group col-md-6">';
    html += '<label>Produkt</label>';
    html += selectBox;
    html += '</div >';
    html += '<div class="form-group col-md-2">';
    html += '<label>Cena</label>';
    html += '<input type="number" step="0.001" class="form-control price" name="price[]" value = "0">';
    html += '</div>';
    html += '<div class="form-group col-md-2">';
    html += '<label>Ilośc</label>';
    html += '<input type="number" step="0.001" class="form-control amount" name="amount[]" value = "1">';
    html += '</div>';
    html += '<div class="form-group col-md-2">';
    html += '<label>Rabat</label>';
    html += '<input type="number" step="0.001" class="form-control discount" name="discount[]" value = "0">';
    html += '</div>';
    html += '</div>';
    shoppinglist.innerHTML = html;

    item = new shopList(-1, 0, 1, 0);
    shopListItems.push(item);
    box = document.getElementsByClassName('selectBox');

    for (var i = 0; i < box.length; i++) {
        (function (i) {
            box[i].addEventListener('change', function () {
                optionsFields = box[i].getElementsByClassName('optionsFields');
                price = document.getElementsByClassName('price')
                amount = document.getElementsByClassName('amount');
                discount = document.getElementsByClassName('discount');

                for (var j = 0; j < prices.length; j++) {
                    if (optionsFields[j].selected) {
                        shopListItems[i].id = j;
                        price[i].value = prices[j];
                        shopListItems[i].price = prices[j];
                    }
                }
            }, false);
        })(i);
    }

    insertValue();
    initNewPosition();
    counter++;
});

button.click();

function initNewPosition() {

    let price = document.getElementsByClassName('price');
    let amount = document.getElementsByClassName('amount');
    let discount = document.getElementsByClassName('discount');

    for (var i = 0; i < price.length; i++) {
        (function (i) {
            price[i].addEventListener('change', function (event) {
                shopListItems[i].price = price[i].value;
            }, false);

            amount[i].addEventListener('change', function (event) {
                shopListItems[i].amount = amount[i].value;
            }, false);

            discount[i].addEventListener('change', function (event) {
                shopListItems[i].discount = discount[i].value;
            }, false);
        })(i);
    }
}

function insertValue() {
    let price = document.getElementsByClassName('price');
    let amount = document.getElementsByClassName('amount');
    let discount = document.getElementsByClassName('discount');
    let box = document.getElementsByClassName('selectBox');

    for (var i = 0; i < price.length - 1; i++) {
        var options = box[i].getElementsByClassName('optionsFields');

        for (var j = 0; j < options.length; j++) {
            if (shopListItems[i].id == j) {
                options[j].selected = 'selected';
            }
        }

        price[i].value = shopListItems[i].price;
        amount[i].value = shopListItems[i].amount;
        discount[i].value = shopListItems[i].discount;
    }
}

// Wybierz shoplist o konkretnej dacie
