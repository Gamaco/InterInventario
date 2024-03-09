$(document).ready(function () {
    $(".dropdown-item").click(function () {
        var selectedCondition = $(this).text(); // Get the text of the clicked item
        $("#conditionDropdownButton").text(selectedCondition); // Update the button text
        $("#condition").val(selectedCondition); // Update the hidden input value
    });
});


// Add event listener to the textarea
document.getElementById('comments').addEventListener('input', function () {
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