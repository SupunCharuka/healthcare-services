$(document).ready(function() {
    function setColumnStyles() {
        var maxHeight = 0;
        $(".inner-box").each(function() {
            var columnHeight = $(this).height();
            if (columnHeight > maxHeight) {
                maxHeight = columnHeight;
            }
        });

        $(".inner-box").height("auto"); // Reset height to auto

        maxHeight = maxHeight + 10;
        // Set the maximum height for all columns
        var maxHeightValue = Math.max(maxHeight, 100); // Set a minimum height of 100px
        $(".inner-box").height(maxHeightValue);
    }

    // Call the function on page load
    setColumnStyles();

    // Call the function on window resize
    $(window).resize(function() {
        setColumnStyles();
    });
});