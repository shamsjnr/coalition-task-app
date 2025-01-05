window.addEventListener('load', function() {

    // Hide Modal by Modal click
    document.querySelectorAll('.modal')?.forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target.classList.contains('modal'))
                modal.classList.remove('show');
        })
    });

    // Show Modal
    const modalButtons = document.querySelectorAll('[data-show-modal]');
    modalButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = btn.dataset['showModal'];
            document.querySelector(`#${modal}`)?.classList?.add('show');
        });
    });

    // Hide Modal by close button
    document.querySelectorAll('[data-hide-modal]')?.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = btn.dataset['hideModal'];
            document.querySelector(`#${modal}`)?.classList?.remove('show');
        });
    });

    // Remove Flash data
    const flash = document.querySelector('#status');
    if (flash) {
        setTimeout(() => {
            flash.remove();
        }, 5000); // Remove message after 5 seconds
    }

    // Checkboxes
    const addBtn = document.querySelector('#addToProject');
    const tasksInput = document.querySelector('#tasks');
    document.querySelectorAll('.project-task')?.forEach(checkbox => {
        checkbox.addEventListener('change', e => {
            const checks = document.querySelectorAll('.project-task:checked');
            (checks?.length) ? addBtn.classList.remove('hidden') : addBtn.classList.add('hidden');

            const tasks = Array.from(checks)?.flatMap(check => check.value);
            tasksInput.value = tasks
        });
    });
});
