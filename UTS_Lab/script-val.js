document.addEventListener("DOMContentLoaded", function() {
    var deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var taskId = this.getAttribute('data-task-id'); 
            document.getElementById('deleteInput').value = taskId;
        });
    });
});

var editModal = document.getElementById('editModal');
var editForm = document.getElementById('editForm');
var editButtons = document.querySelectorAll('.edit-btn');

editButtons.forEach(function(editButton) {
    editButton.addEventListener('click', function() {
        var taskId = editButton.getAttribute('data-task-id');
        var task = editButton.getAttribute('data-tasks');
        var status = editButton.getAttribute('data-status');
        var priority = editButton.getAttribute('data-priority');

        document.getElementById('editTaskId').value = taskId;
        document.getElementById('editTasks').value = task;

        var statusSelect = document.getElementById('statusSelect');
        statusSelect.value = status;

        var prioritySelect = document.getElementById('editPrioritySelect');
        prioritySelect.value = priority;
    });
});