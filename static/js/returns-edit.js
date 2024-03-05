$(document).ready(function() {
    $(".dropdown-item").click(function() {
        var selectedCondition = $(this).text(); // Get the text of the clicked item
        $("#conditionDropdownButton").text(selectedCondition); // Update the button text
        $("#condition").val(selectedCondition); // Update the hidden input value
    });
});