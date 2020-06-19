var datePicker = document.getElementById('date');
var date = datePicker.value;

datePicker.addEventListener('change', function () {
    date = datePicker.value;
    getShoppingListWithFullDate(date);
})


function getShoppingListWithFullDate(date) {
    $.ajax({
        url: "./ajax/viewShoppingListWithFullDate.php",
        cache: false,

        data: {
            date: date
        },

        success: function (data) {
            $('#shopppingList').html(data);
        }
    });
}

window.addEventListener('keydown', (e) => {
    switch (e.keyCode) {
        case 37: {
            var d = new Date(date);
            d.setDate(d.getDate() - 1);
            date = formatDate(d);
            datePicker.value = date;
            getShoppingListWithFullDate(date);

            break;
        }
        case 39: {
            var d = new Date(date);
            d.setDate(d.getDate() + 1);
            date = formatDate(d);
            datePicker.value = date;
            getShoppingListWithFullDate(date);
            break;
        }
    }

})

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}