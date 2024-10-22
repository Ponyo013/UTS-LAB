document.addEventListener('DOMContentLoaded', function() {
    const selectPriority = document.getElementById('editPrioritySelect');
    const selectStatus = document.getElementById('statusSelect');

    function updatePriorityClass() {
        selectPriority.classList.remove('priority-high', 'priority-medium', 'priority-low');

        if (selectPriority.value === 'High') {
            selectPriority.classList.add('priority-high');
        } else if (selectPriority.value === 'Medium') {
            selectPriority.classList.add('priority-medium');
        } else if (selectPriority.value === 'Low') {
            selectPriority.classList.add('priority-low');
        }
    }

    function updateStatusClass() {
        selectStatus.classList.remove('status-done', 'status-in-progress', 'status-in-queue');

        if (selectStatus.value === 'Done') {
            selectStatus.classList.add('status-done');
        } else if (selectStatus.value === 'In progress') {
            selectStatus.classList.add('status-in-progress');
        } else if (selectStatus.value === 'In queue') {
            selectStatus.classList.add('status-in-queue');
        }
    }

    selectPriority.addEventListener('change', updatePriorityClass);
    selectStatus.addEventListener('change', updateStatusClass);

    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(function(editButton) {
        editButton.addEventListener('click', function() {
            var taskId = editButton.getAttribute('data-task-id');
            var task = editButton.getAttribute('data-tasks');
            var status = editButton.getAttribute('data-status');
            var priority = editButton.getAttribute('data-priority');

            document.getElementById('editTaskId').value = taskId;
            document.getElementById('editTasks').value = task;

            selectStatus.value = status;
            updateStatusClass(); 

            selectPriority.value = priority;
            updatePriorityClass(); 
        });
    });
});
