
// <!-- Get Item PTag and Close Modal -->
function getPTagFromModal(Ptag) {
    var inputField = document.getElementById('PTAG');
    inputField.value = Ptag;
    $('#inventoryList').modal('hide');
}

$(document).ready(function () {
    // Event delegation for handling click on dropdown items for the first dropdown
    $('#affiliationDropdown').on('click', '.dropdown-item', function () {
        var selectedText = $(this).text();
        $('#AffiliationButton').text(selectedText);
        $('#AFFILIATION').val(selectedText);
    });
});

function validateLoanCreationInputs() {
    let ptagSelection = document.getElementById('PTAG');
    if (ptagSelection.value === '') {
        alert("Missing field 'PTag.'");
        return false;
    }
    document.getElementById('PTAG').disabled = false;
    return true;
}
