$(document).ready(function () {
    $("#discount-form").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            type: "POST",
            url: "includes/API/discountcodeAPI.php", // The API URL
            data: $(this).serialize(), // Serialize the form data
            success: function (response) {
                // Check if the response contains "Congratulations!"
                if (response.includes("Congratulations!")) {
                    // Apply a CSS class for success (green)
                    $("#message").html(response).addClass("success-message").removeClass("error-message");
                } else {
                    // Apply a CSS class for error (red)
                    $("#message").html(response).addClass("error-message").removeClass("success-message");
                }
            },
            error: function () {
                window.alert("Coupons are currently unavaliable! Please try again soon");
            }
        });
    });
});