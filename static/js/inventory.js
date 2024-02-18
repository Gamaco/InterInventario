document.getElementById('searchInput').addEventListener('input', function () {
  const searchText = this.value.toLowerCase();
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');

  tableRows.forEach(row => {
    const rowData = row.textContent.toLowerCase();
    row.style.display = rowData.includes(searchText) ? '' : 'none';
  });
});

  // Add event listener to the dropdown items
  categoryDropdown.addEventListener('click', function(event) {
  // Get the button and dropdown elements
  var dropdownButton = document.querySelector('.dropdown-toggle');
  var categoryDropdown = document.getElementById('categoryDropdown');

    // Check if a dropdown item was clicked
    if (event.target.classList.contains('dropdown-item')) {
      // Update the button text with the selected item
      dropdownButton.innerText = event.target.innerText;
    }
  });