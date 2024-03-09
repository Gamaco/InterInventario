
// <!-- Get Item PTag and Close Modal -->
function getPTagFromModal(Ptag) {
    var inputField = document.getElementById('PTAG');
    inputField.value = Ptag;
    $('#inventoryList').modal('hide');
}

$(document).ready(function () {
    // Event delegation for handling click on dropdown items
    $('.dropdown-menu').on('click', '.dropdown-item', function () {
        // Get the text of the clicked item
        var selectedText = $(this).text();

        // Update the button text with the selected item text
        $(this).closest('.dropdown-center').find('.dropdown-toggle').text(selectedText);
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
