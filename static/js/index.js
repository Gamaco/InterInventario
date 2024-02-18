document.getElementById('searchInput').addEventListener('input', function () {
    const searchText = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#dataTable tbody tr');

    tableRows.forEach(row => {
      const rowData = row.textContent.toLowerCase();
      row.style.display = rowData.includes(searchText) ? '' : 'none';
    });
  });