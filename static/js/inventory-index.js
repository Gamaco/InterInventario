

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
