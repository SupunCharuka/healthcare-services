var prevLanguage = readCookie("googtrans");
function googleTranslateElementInit() {
    const translator = new google.translate.TranslateElement(
        {
            pageLanguage: "en",
            includedLanguages: "en,si,ta,de,ru,ar",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
        },
        "google_translate_element"
    );
}

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + expiry * 24 * 60 * 60 * 1000);
    document.cookie = key + "=" + value + ";expires=" + expires.toUTCString();
}

function readCookie(name) {
    var c = document.cookie.split("; "),
        cookies = {},
        i,
        C;

    for (i = c.length - 1; i >= 0; i--) {
        C = c[i].split("=");
        cookies[C[0]] = C[1];
    }

    return cookies[name];
}


setInterval(function () {
    var currentLanguage = readCookie("googtrans");

    if (currentLanguage !== prevLanguage) {
        updateLanguage(currentLanguage);
        prevLanguage = currentLanguage;
    }

}, 1000);

function updateLanguage(language) {
    $.ajax({
        url: APP_URL + "/set-language",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: { language: language },
        dataType: "JSON",

        success: function (response) {
            if (response.success) {
                console.log("Language updated successfully");
                location.reload();
            } else {
                console.log("Language updated");
                location.reload();
            }
        },
        error: function (error) {
            console.error("Error updating language:", error);
        },
    });
}

