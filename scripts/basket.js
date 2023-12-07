function validateForm() {
    // Validate payment form fields
    var cardholderName = document.getElementById("formControlLgXsd").value;
    var cardNumber = document.getElementById("formControlLgXM").value;
    var cardExpire = document.getElementById("formControlLgExpk").value;
    var cardCvv = document.getElementById("formControlLgcvv").value;

    // Check if card details are filled
    if (cardholderName === "" || cardNumber === "" || cardExpire === "" || cardCvv === "") {
        alert("Please fill in all the required payment fields.");
        return false;
    }

    // Validate card number (simple check for length, typically 16 digits)
    if (cardNumber.length !== 16 || isNaN(cardNumber)) {
        alert("Please enter a valid 16-digit card number.");
        return false;
    }

    // Validate card expiration date (format MM/YYYY)
    var expRegEx = /^(0[1-9]|1[0-2])\/\d{4}$/;
    if (!expRegEx.test(cardExpire)) {
        alert("Please enter a valid expiration date in the format MM/YYYY.");
        return false;
    }

    // Validate CVV (3 or 4 digits)
    if (cardCvv.length < 3 || cardCvv.length > 4 || isNaN(cardCvv)) {
        alert("Please enter a valid CVV.");
        return false;
    }

    if (cardholderName === "" || cardNumber === "" || cardExpire === "" || cardCvv === "") {
        alert("Please fill in all the required payment fields.");
        return false;
    }

    // Validate billing address fields
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var address = document.getElementById("address").value;
    var country = document.getElementById("country").value;
    var city = document.getElementById("city").value;
    var zip = document.getElementById("zip").value;

    if (firstName === "" || lastName === "" || address === "" || country === "" || city === "" || zip === "") {
        alert("Please fill in all the required billing address fields.");
        return false;
    }

    // If validation passes, submit the form data using AJAX
    submitFormData();

    // Prevent default form submission
    return false;
}

function submitFormData() {
    var formData = $('#paymentForm').serialize(); // Serialize the form data

    $.ajax({
        type: 'POST',
        url: 'basket.php', // Form submission endpoint
        data: formData,
        success: function(response) {
            // Run confetti animation
            confettiAnimation();
        },
        error: function() {
            alert('Error in form submission.');
        }
    });
}

function confettiAnimation() {
    confetti({
        particleCount: 500,
        spread: 120,
        origin: { y: 0.6 }
    });
    setTimeout(function () {
        window.alert('Your order has been placed! Expect an email confirmation in the coming minutes');
    }, 1000);
}