

// <!-- Item Deletion Warning Modal (Are you sure you want to delete?) -->
var itemDeletionModal = document.getElementById('itemDeletionModal');
itemDeletionModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var itemId = button.getAttribute('data-item-id'); // Extract info from data-* attributes
    var modal = this;
    modal.querySelector('#itemIdToDelete').textContent = itemId;
    modal.querySelector('#confirmDeleteBtn').addEventListener('click', function () {
        // Perform deletion action here using the itemId
        window.location.href = './delete.php?id=' + itemId;
    });
});


// <!-- Minimize button functionality -->
document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('InventoryTable');
    var button = document.getElementById('minimizeButton');
    var isTableMinimized = false;

    button.addEventListener('click', function () {
        if (!isTableMinimized) {
            table.style.display = 'none';
            button.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i> Show';
        } else {
            table.style.display = 'table';
            button.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i> Hide';
        }
        isTableMinimized = !isTableMinimized;
    });
});