window.onload = function () {

    let form = document.getElementById('form'),
        button = document.getElementById('feedback-button'),
        sms = document.getElementById('sms'),
        calling = document.getElementById('calling'),
        checkboxTextWrap = document.querySelectorAll(".checkbox__wrap");


    document.querySelectorAll('.range_box input').forEach(item => {
        let gadgetEvent = '';
        if (window.innerWidth < 1024) {
            gadgetEvent = 'touchmove';
        } else {
            gadgetEvent = 'mousemove';
        }
        item.addEventListener(`${gadgetEvent}`, function () {
            let rangeName = '';
            if (this.name === 'amount') {
                rangeName = 'BYN';
            } else {
                rangeName = 'мес';
            }
            this.closest('.range_box').querySelector('.rangeValue').innerHTML = `${this.value} ${rangeName}`;
        })
    });

    sms.addEventListener('click', function () {
        calling.checked = false;
    });
    calling.addEventListener('click', function () {
        sms.checked = false;
    });

    button.onclick = function () {
        let error = 0;
        let array = [];
        if (form.elements.length > 0) {
            Array.from(form.elements).forEach((el) => {
                array.push({
                    name: el.getAttribute('data-name'),
                    value: el.value,
                    required: el.required
                });
                if ((el.value == "" || (el.checked === false && el.value == "on")) && el.required === true) {
                    el.classList.add('error');
                    error++;
                } else {
                    el.classList.remove('error');
                };
            });
        };

        if ((!sms.checked) && (!calling.checked)) {
            checkboxTextWrap.forEach(el => {
                el.classList.add('error');
            });
            error++;
        } else {
            checkboxTextWrap.forEach(el => {
                el.classList.remove('error');
            });
        }

        if (error === 0) {
            $.ajax({
                url: form.getAttribute('data-action'),
                method: "post",
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (data) {
                    let info = JSON.parse(data);
                    Swal.fire({
                        icon: info.status,
                        title: info.message,
                        timer: 5000
                    })
                    form.reset(); 
                    document.querySelectorAll('.range_box .rangeValue').forEach(item => {
                        let rangeName = '';
                        if (this.name === 'amount') {
                            rangeName = 'BYN';
                        } else {
                            rangeName = 'мес';
                        }
                        item.innerHTML = `${item.previousSibling.previousSibling.value} ${rangeName}`;
                    });
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Заполните все поля!',
                timer: 5000
            })
        }
    };
};