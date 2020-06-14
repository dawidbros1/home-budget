var datePicker = document.getElementById('date');
var dataBox = document.getElementsByClassName('dataBox');

// Init 

for (var i = 0; i < dataBox.length; i++) {
    let dataBoxTime = dataBox[i].getElementsByClassName('time')[0];

    if (datePicker.value == "") {
        dataBox[i].style.display = "flex";
    }
    else {
        if (datePicker.value != dataBoxTime.value) {
            dataBox[i].style.display = "none";
        }
        else {
            dataBox[i].style.display = "flex";
        }
    }
}

// END

datePicker.addEventListener('change', function () {
    for (var i = 0; i < dataBox.length; i++) {
        let dataBoxTime = dataBox[i].getElementsByClassName('time')[0];

        if (datePicker.value == "") {
            dataBox[i].style.display = "flex";
        }
        else {
            if (datePicker.value != dataBoxTime.value) {
                dataBox[i].style.display = "none";
            }
            else {
                dataBox[i].style.display = "flex";
            }
        }
    }
})

