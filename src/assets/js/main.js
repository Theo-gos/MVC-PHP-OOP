const checkBoxes = document.querySelectorAll('.item_checkbox');

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