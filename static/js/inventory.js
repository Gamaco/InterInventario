
document.getElementById('searchInput').addEventListener('input', function () {
  const searchText = this.value.trim().toLowerCase();
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');

  tableRows.forEach(row => {
    const rowData = row.textContent.trim().toLowerCase();
    row.style.display = rowData.includes(searchText) ? '' : 'none';
  });

});


var dropdownButton = document.querySelector('.dropdown-toggle');
var categoryDropdown = document.getElementById('categoryDropdown');

// Add event listener to the dropdown items
categoryDropdown.addEventListener('click', function(event) {
  // Check if a dropdown item was clicked
  if (event.target.classList.contains('dropdown-item')) {

    // Update the button text with the selected item
    //dropdownButton.innerText = event.target.innerText.trim();

    // Get the selected category
    const selectedCategory = event.target.innerText.trim().toLowerCase();

    // Filter the table based on the selected category
    filterTable(selectedCategory);
  }
});

function filterTable(filterText) {
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');

  tableRows.forEach(row => {
    // Display all rows when "All Categories" is selected
    if (filterText === 'all categories') {
      row.style.display = '';
    } 
    else {
      const descriptionCell = row.cells[2];

      // Check if the description column exists in the row
      if (descriptionCell) {
        const descriptionText = descriptionCell.textContent.trim().toLowerCase();

        // Display the row if filterText exists in the description
        row.style.display = (descriptionText.includes(filterText.toLowerCase())) ? '' : 'none';
      } else {
        // If description column doesn't exist, hide the row
        row.style.display = 'none';
      }
    }
  });
}

