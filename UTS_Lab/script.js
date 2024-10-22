$(document).ready(function () {
    $('#TaskTable').DataTable({
        paging: false,
        info: false,
        lengthChange: false
    });
});

const selectElement = document.getElementById('prioritySelect');
selectElement.addEventListener('change', function () {
    this.classList.remove('priority-high', 'priority-medium', 'priority-low');

    if (this.value === 'High') {
        this.classList.add('priority-high');
    } else if (this.value === 'Medium') {
        this.classList.add('priority-medium');
    } else if (this.value === 'Low') {
        this.classList.add('priority-low');
    }
});

function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const profileImage = document.getElementById('profileImage');
        profileImage.src = e.target.result; 
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

function filterTasks(filterValue) {
    const tableRows = document.querySelectorAll('#TaskTable tbody tr');

    tableRows.forEach(row => {
        const status = row.getAttribute('data-status');

        if (filterValue === "all") {
            row.style.display = ""; 
        } else if (filterValue === "done" && status === "Done") {
            row.style.display = ""; 
        } else if (filterValue === "not-done" && (status === "In progress" || status === "In queue")) {
            row.style.display = ""; 
        } else {
            row.style.display = "none"; 
        }
    });
}

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
