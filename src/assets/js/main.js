const checkBoxes = document.querySelectorAll('.item_checkbox');
const form = document.querySelector('.form');

checkBoxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function (e) {
        const toDoItem = e.target.closest('.to-do-item');
        const targetedField = toDoItem.querySelectorAll('div:not(.item_controls)');
        const checkedStatus = this.querySelector('.check').checked;

        if (checkedStatus) {
            targetedField.forEach(field => {
                field.classList.add('line-through');
            })
        } else {
            targetedField.forEach(field => {
                field.classList.remove('line-through');
            })
        }
    })
})

if (form) {
    const inputs = form.querySelectorAll('input:not([type="submit"]):not([type="checkbox"])');
    console.log(inputs);

    inputs.forEach(input => {
        input.addEventListener('input', e => {
            const id = input.id;
            if (!form.querySelector('#' +  id + ' + .error-p').classList.contains('hidden')) { 
                form.querySelector('#' +  id + ' + .error-p').classList.add('hidden');
            } 
            input.style = null;
        });
    }) 

    function validateForm() {

        const title = form.querySelector('#title');
        const description = form.querySelector('#desc');
        const dueDate = form.querySelector('#due');

        const name = form.querySelector('#name');
        const email = form.querySelector('#email');
        const password = form.querySelector('#password');
        const repeatPassword = form.querySelector('#repeat-password');

        if (title) {  
            description.addEventListener('input', e => {
                if (!form.querySelector('#desc + .error-p').classList.contains('hidden')) { 
                    form.querySelector('#desc + .error-p').classList.add('hidden');
                } 
                description.style = null;
            });
            
            if (title.value == '') {
                form.querySelector('#title + .error-p').classList.remove('hidden');
                form.querySelector('#title + .error-p').innerHTML = 'Please fill out this field!';
                title.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (title.length > 255) {
                form.querySelector('#title + .error-p').classList.remove('hidden');
                form.querySelector('#title + .error-p').innerHTML = 'Title is too long';
                title.style = 'border-color: rgb(239 68 68);';
                return false;
            }

            if (description.value == '') {
                form.querySelector('#desc + .error-p').classList.remove('hidden');
                form.querySelector('#desc + .error-p').innerHTML = 'Please fill out this field!';
                description.style = 'border-color: rgb(239 68 68);';
                return false;
            }

            if (dueDate.value == '') {
                form.querySelector('#due + .error-p').classList.remove('hidden');
                form.querySelector('#due + .error-p').innerHTML = 'Please select a date!';
                dueDate.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (new Date(dueDate.value) < Date.now()) {
                form.querySelector('#due + .error-p').classList.remove('hidden');
                form.querySelector('#due + .error-p').innerHTML = 'Please select a valid date!';
                dueDate.style = 'border-color: rgb(239 68 68);';
                return false;
            }
        }

        if (email) {
            if (name.value == '') {
                form.querySelector('#name + .error-p').classList.remove('hidden');
                form.querySelector('#name + .error-p').innerHTML = 'Please fill out this field!';
                title.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (name.length > 255) {
                form.querySelector('#name + .error-p').classList.remove('hidden');
                form.querySelector('#name + .error-p').innerHTML = 'Name is too long';
                title.style = 'border-color: rgb(239 68 68);';
                return false;
            }

            if (email.value == '') {
                form.querySelector('#email + .error-p').classList.remove('hidden');
                form.querySelector('#email + .error-p').innerHTML = 'Please fill out this field!';
                email.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (email.length > 255) {
                form.querySelector('#email + .error-p').classList.remove('hidden');
                form.querySelector('#email + .error-p').innerHTML = 'email is too long';
                email.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (!email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                form.querySelector('#email + .error-p').classList.remove('hidden');
                form.querySelector('#email + .error-p').innerHTML = 'invalid email';
                email.style = 'border-color: rgb(239 68 68);';
                return false;
            }

            if (password.value == '') {
                form.querySelector('#password + .error-p').classList.remove('hidden');
                form.querySelector('#password + .error-p').innerHTML = 'Please fill out this field!';
                password.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (password.length > 500) {
                form.querySelector('#password + .error-p').classList.remove('hidden');
                form.querySelector('#password + .error-p').innerHTML = 'password is too long';
                password.style = 'border-color: rgb(239 68 68);';
                return false;
            }

            if (repeatPassword.value == '') {
                form.querySelector('#repeat-password + .error-p').classList.remove('hidden');
                form.querySelector('#repeat-password + .error-p').innerHTML = 'Please fill out this field!';
                repeatPassword.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (repeatPassword.length > 500) {
                form.querySelector('#repeat-password + .error-p').classList.remove('hidden');
                form.querySelector('#repeat-password + .error-p').innerHTML = 'Repeat Password is too long';
                repeatPassword.style = 'border-color: rgb(239 68 68);';
                return false;
            } else if (repeatPassword.value !== password.value) {
                form.querySelector('#repeat-password + .error-p').classList.remove('hidden');
                form.querySelector('#repeat-password + .error-p').innerHTML = 'Password is not match';
                repeatPassword.style = 'border-color: rgb(239 68 68);';
                return false;
            }
        }

        return true;
    }

    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
        }
    })
}