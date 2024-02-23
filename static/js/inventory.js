
document.getElementById('searchInput').addEventListener('input', function () {
  const searchText = this.value.trim().toLowerCase();
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');

  tableRows.forEach(row => {
    const rowData = row.textContent.trim().toLowerCase();
    row.style.display = rowData.includes(searchText) ? '' : 'none';
  });

  dropdownButton.innerText = "All Category";
});


var dropdownButton = document.querySelector('.dropdown-toggle');
var categoryDropdown = document.getElementById('categoryDropdown');

// Add event listener to the dropdown items
categoryDropdown.addEventListener('click', function(event) {
  // Check if a dropdown item was clicked
  if (event.target.classList.contains('dropdown-item')) {
    // Update the button text with the selected item
    dropdownButton.innerText = event.target.innerText.trim();

    // Get the selected category
    const selectedCategory = event.target.innerText.trim().toLowerCase();

    // Filter the table based on the selected category
    filterTable(selectedCategory);
  }
});

function filterTable(filterText) {
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');

  tableRows.forEach(row => {
    const descriptionCell = row.cells[2];
    
    // Check if the description column exists in the row
    if (descriptionCell) {
      const descriptionText = descriptionCell.textContent.trim().toLowerCase();
      
      // Check if the filterText is 'all category' or exists in the description
      if (filterText === 'all category' || descriptionText.includes(filterText.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    }
  });
}

