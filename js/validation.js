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
            this.closest('.range_box').querySelector('.rangeValue').innerHTML = `${this.value} ${this.name}`;
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
        if (form.elements.length > 0) {
            Array.from(form.elements).forEach((el) => {
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
            Swal.fire({
                icon: 'success',
                title: 'Спасибо за заявку!',
                timer: 5000
            })
            form.reset();
            document.querySelectorAll('.range_box .rangeValue').forEach(item => {
                item.innerHTML = `${item.previousSibling.previousSibling.value} ${item.previousSibling.previousSibling.name}`;
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Заполните все поля!',
                timer: 5000
            })
        }
    };
};