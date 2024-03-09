var returnButtons = document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]');
returnButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        var ptagValue = this.getAttribute('data-item-id');
        var descriptionValue = this.getAttribute('data-item-description');
        var ptagInput = document.getElementById('PTAG');
        var descriptionInput = document.getElementById('Description');
        descriptionInput.value = descriptionValue;
        ptagInput.value = ptagValue;
    });
});



// Get the dropdown button and menu for condition dropdown
var conditionDropdownButton = document.getElementById('conditionDropdownButton');
var conditionDropdownMenu = document.getElementById('conditionDropdownMenu');

// Add event listeners to each dropdown item for condition dropdown
var conditionDropdownItems = conditionDropdownMenu.querySelectorAll('.dropdown-item');
conditionDropdownItems.forEach(function (item) {
    item.addEventListener('click', function () {
        // Set the text of the dropdown button to the selected item's text
        conditionDropdownButton.textContent = this.textContent;

        // Check the selected item's text and adjust the button color accordingly
        if (this.textContent === "Damaged") {
            conditionDropdownButton.classList.remove('btn-primary', 'btn-warning');
            conditionDropdownButton.classList.add('btn-danger');
        } else if (this.textContent === "Incomplete") {
            conditionDropdownButton.classList.remove('btn-primary', 'btn-danger');
            conditionDropdownButton.classList.add('btn-warning');
        } else {
            conditionDropdownButton.classList.remove('btn-danger', 'btn-warning');
            conditionDropdownButton.classList.add('btn-primary');
        }
    });
});


$(document).ready(function() {
    $(".dropdown-item").click(function() {
        var selectedCondition = $(this).text(); // Get the text of the clicked item
        $("#conditionDropdownButton").text(selectedCondition); // Update the button text
        $("#condition").val(selectedCondition); // Update the hidden input value
    });
});

// Display characters count and the limit.
    // Add event listener to the textarea
    document.getElementById('Fault').addEventListener('input', function() {
        // Get the current character count
        var charCount = this.value.length;
        // Get the maximum character limit
        var maxLength = parseInt(this.getAttribute('maxlength'));
        // Update the character count display
        document.getElementById('charCount').textContent = charCount + '/' + maxLength + ' characters';
        // Trim the text if it exceeds the limit
        if (charCount > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }
    });

// Enables disabled inputs so that the data can be sent serverside.
function enableInputs() {
    document.getElementById("PTAG").disabled = false;
    document.getElementById("Description").disabled = false;
}
