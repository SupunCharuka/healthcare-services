window.addEventListener("load", function () {
    var visitorTypeCookie = getCookie("visitor_type");
    if (!visitorTypeCookie) {
        var popupContainer = document.getElementById("popup-container");
        popupContainer.style.display = "block";
    } else if (visitorTypeCookie === "foreign" && window.location.pathname === "/") {
        var url = APP_URL + '/foreign';
        if (visitorTypeCookie) {
            url += '?visitor_type=' + encodeURIComponent(visitorTypeCookie);
        }
        window.location.href = url;
    }

    var localBtn = document.getElementById("local-btn");
    var foreignBtn = document.getElementById("foreign-btn");

    localBtn.addEventListener("click", function () {
        // Set a cookie indicating local visitors
        setCookie("visitor_type", "local", 7); // Set the cookie to expire in 7 days
        var popupContainer = document.getElementById("popup-container");
        popupContainer.style.display = "none"; // Hide the popup container
    });

    foreignBtn.addEventListener("click", function () {
        // Set a cookie indicating foreign visitors
        setCookie("visitor_type", "foreign", 7); // Set the cookie to expire in 7 days
        var visitorTypeCookie = getCookie("visitor_type");
        var url = APP_URL + '/foreign';

        if (visitorTypeCookie) {
            url += '?visitor_type=' + encodeURIComponent(visitorTypeCookie);
        }

        window.location.href = url; // Redirect to the foreign visitors page with the visitor_type query parameter
    });


    // Helper function to get a cookie value
    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length === 2) {
            return parts.pop().split(";").shift();
        }
    }

    // Helper function to set a cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
});
