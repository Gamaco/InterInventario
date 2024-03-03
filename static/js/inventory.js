
document.getElementById('searchInput').addEventListener('input', function () {
  const searchText = this.value.trim().toLowerCase();
  const tableRows = document.querySelectorAll('#InventoryTable tbody tr');
  let displayedRowCount = 0; // Initialize counter for displayed rows

  tableRows.forEach(row => {
    const rowData = row.textContent.trim().toLowerCase();
    row.style.display = rowData.includes(searchText) ? '' : 'none';
    if (row.style.display !== 'none') {
      displayedRowCount++; // Increment the counter for displayed rows
    }
  });

  if (!searchText == "") {
    // Update the counter element in your HTML
    document.getElementById('displayedRowCount').textContent = displayedRowCount + " items found for \'" + searchText.toUpperCase() + "'";
  } else {
    document.getElementById('displayedRowCount').textContent = "";
  }
});



var dropdownButton = document.querySelector('.dropdown-toggle');
var categoryDropdown = document.getElementById('categoryDropdown');

// Add event listener to the dropdown items
categoryDropdown.addEventListener('click', function(event) {
  event.preventDefault();
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
  let displayedRowCount = 0; // Initialize counter for displayed rows

  tableRows.forEach(row => {
    const descriptionCell = row.cells[0];

    if (filterText === 'all categories' || !descriptionCell) {
      // Display all rows when "All Categories" is selected or if there's no description column
      row.style.display = '';
      displayedRowCount++; // Increment the counter for displayed rows
    } else {
      const descriptionText = descriptionCell.textContent.trim().toLowerCase();

      // Display the row if filterText exists in the description
      if (descriptionText.includes(filterText.toLowerCase())) {
        row.style.display = '';
        displayedRowCount++; // Increment the counter for displayed rows
      } else {
        row.style.display = 'none';
      }
    }
  });

  if (!(filterText == "all categories")) {
    // Update the counter element in your HTML
    document.getElementById('displayedRowCount').textContent = displayedRowCount + " items found for \'" + filterText.toUpperCase() + "'";
  } else {
    document.getElementById('displayedRowCount').textContent = "";
  }
}

