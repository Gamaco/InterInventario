document.getElementById('searchInput').addEventListener('input', function () {
  const searchText = this.value.trim().toLowerCase();
  
  // Filter InventoryTable if it exists
  const inventoryTable = document.getElementById('InventoryTable');
  if (inventoryTable) {
    const inventoryTableRows = inventoryTable.querySelectorAll('tbody tr');
    let inventoryDisplayedRowCount = 0; // Initialize counter for displayed rows

    inventoryTableRows.forEach(row => {
      const rowData = row.textContent.trim().toLowerCase();
      row.style.display = rowData.includes(searchText) ? '' : 'none';
      if (row.style.display !== 'none') {
        inventoryDisplayedRowCount++; // Increment the counter for displayed rows
      }
    });
  }

  // Filter InventoryTable-OutOfStock if it exists
  const outOfStockTable = document.getElementById('InventoryTable-OutOfStock');
  if (outOfStockTable) {
    const outOfStockTableRows = outOfStockTable.querySelectorAll('tbody tr');
    let outOfStockDisplayedRowCount = 0; // Initialize counter for displayed rows

    outOfStockTableRows.forEach(row => {
      const rowData = row.textContent.trim().toLowerCase();
      row.style.display = rowData.includes(searchText) ? '' : 'none';
      if (row.style.display !== 'none') {
        outOfStockDisplayedRowCount++; // Increment the counter for displayed rows
      }
    });
  }

    // Filter InventoryTable-OutOfStock if it exists
    const loansTable = document.getElementById('InventoryTable-OutOfStock');
    if (loansTable) {
      const loansTableRows = outOfStockTable.querySelectorAll('tbody tr');
      let loansDisplayedRowCount = 0; // Initialize counter for displayed rows
  
      loansTableRows.forEach(row => {
        const rowData = row.textContent.trim().toLowerCase();
        row.style.display = rowData.includes(searchText) ? '' : 'none';
        if (row.style.display !== 'none') {
          loansDisplayedRowCount++; // Increment the counter for displayed rows
        }
      });
    }

  // Update the counter element in HTML
    if (inventoryDisplayedRowCount > 0 && outOfStockDisplayedRowCount > 0) {
      document.getElementById('displayedRowCount').textContent = inventoryDisplayedRowCount + outOfStockDisplayedRowCount + " Items found for \'" + searchText.toUpperCase() + "'";
    } else if (inventoryDisplayedRowCount > 0 && outOfStockDisplayedRowCount === 0) {
      document.getElementById('displayedRowCount').textContent = inventoryDisplayedRowCount + " Items found for \'" + searchText.toUpperCase() + "'";
      //outOfStockTable.style.display = 'none'; // Hide InventoryTable-OutOfStock
    } else if (inventoryDisplayedRowCount === 0 && outOfStockDisplayedRowCount > 0) {
      document.getElementById('displayedRowCount').textContent = outOfStockDisplayedRowCount + " Items found for \'" + searchText.toUpperCase() + "'";
      //inventoryTable.style.display = 'none'; // Hide InventoryTable
    } else if (loansDisplayedRowCount > 0) {
      document.getElementById('displayedRowCount').textContent = loansDisplayedRowCount + " Items found for \'" + searchText.toUpperCase() + "'";
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
    dropdownButton.innerText = event.target.innerText.trim();

    // Get the selected category
    const selectedCategory = event.target.innerText.trim().toLowerCase();

    // Filter the table based on the selected category
    filterTable(selectedCategory);
  }
});


function filterTable(filterText) {
  // Filter InventoryTable if it exists
  const inventoryTable = document.getElementById('InventoryTable');
  const outOfStockTable = document.getElementById('InventoryTable-OutOfStock');
  const loansTable = document.getElementById('LoansTable');

  let inventoryDisplayedRowCount = 0; // Initialize counter for displayed rows in InventoryTable
  let outOfStockDisplayedRowCount = 0; // Initialize counter for displayed rows in InventoryTable-OutOfStock
  let loansDisplayedRowCount = 0; // Initialize counter for displayed rows in InventoryTable-OutOfStock

  if (loansTable) {
    const loansTableRows = loansTable.querySelectorAll('tbody tr');

    loansTableRows.forEach(row => {
      const descriptionCell = row.cells[3];
      const descriptionText = descriptionCell.textContent.trim().toLowerCase();

      if (filterText === 'all categories' || descriptionText.includes(filterText.toLowerCase())) {
        row.style.display = '';
        loansDisplayedRowCount++; // Increment the counter for displayed rows
      } else {
        row.style.display = 'none';
      }
    });
  }

  if (inventoryTable) {
    const inventoryTableRows = inventoryTable.querySelectorAll('tbody tr');

    inventoryTableRows.forEach(row => {
      const descriptionCell = row.cells[0];
      const descriptionText = descriptionCell.textContent.trim().toLowerCase();

      if (filterText === 'all categories' || descriptionText.includes(filterText.toLowerCase())) {
        row.style.display = '';
        inventoryDisplayedRowCount++; // Increment the counter for displayed rows
      } else {
        row.style.display = 'none';
      }
    });
  }

  if (outOfStockTable) {
    const outOfStockTableRows = outOfStockTable.querySelectorAll('tbody tr');

    outOfStockTableRows.forEach(row => {
      const descriptionCell = row.cells[0];
      const descriptionText = descriptionCell.textContent.trim().toLowerCase();

      if (filterText === 'all categories' || descriptionText.includes(filterText.toLowerCase())) {
        row.style.display = '';
        outOfStockDisplayedRowCount++; // Increment the counter for displayed rows
      } else {
        row.style.display = 'none';
      }
    });
  }

  // Update the counter element in HTML
  if (inventoryDisplayedRowCount > 0 && outOfStockDisplayedRowCount > 0) {
    document.getElementById('displayedRowCount').textContent = inventoryDisplayedRowCount + outOfStockDisplayedRowCount + " Items found for \'" + filterText.toUpperCase() + "'";
  } else if (inventoryDisplayedRowCount > 0 && outOfStockDisplayedRowCount === 0) {
    document.getElementById('displayedRowCount').textContent = inventoryDisplayedRowCount + " Items found for \'" + filterText.toUpperCase() + "'";
    //outOfStockTable.style.display = 'none'; // Hide InventoryTable-OutOfStock
  } else if (inventoryDisplayedRowCount === 0 && outOfStockDisplayedRowCount > 0) {
    document.getElementById('displayedRowCount').textContent = outOfStockDisplayedRowCount + " Items found for \'" + filterText.toUpperCase() + "'";
    //inventoryTable.style.display = 'none'; // Hide InventoryTable
  } else if (loansDisplayedRowCount > 0) {
    document.getElementById('displayedRowCount').textContent = loansDisplayedRowCount + " Items found for \'" + filterText.toUpperCase() + "'";
    //inventoryTable.style.display = 'none'; // Hide InventoryTable
  } else {
    document.getElementById('displayedRowCount').textContent = "";
  }
}




