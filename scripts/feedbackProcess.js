LOW_RATING_W_MESSAGE = "We are sorry to hear that. We will try to use your feedback to improve this site going forward."
LOW_RATING_WO_MESSAGE = "We are sorry to hear that."
HIGH_RATING_W_MESSAGE = "Thank you for your kind response! We will try to use your feedback to improve this site going forward."
HIGH_RATING_WO_MESSAGE = "Thank you for your kind rating!"


function feedbackProcess() {
    var feedbackFormObj = document.getElementById("feedback_form");
    var email = feedbackFormObj.email.value;
    if (emailValid(email))
        selectResponseMessage(feedbackFormObj)
}

function emailValid(address) {
    var p = address.search(/.+@.+/);
    if (p == 0)
        return true;
    else {
        alert("Error: Invalid e-mail address.");
        return false;
    }
}

function selectResponseMessage(feedbackFormObj) {
    try {
        var rating = document.querySelector('input[name="rating"]:checked').value
        rating = parseInt(rating)
        var comments = feedbackFormObj.comments.value
        if (comments !== "") {
            if (rating < 4)
                alert(LOW_RATING_W_MESSAGE)
            else
                alert(HIGH_RATING_W_MESSAGE)
                
        } else {
            if (rating < 4)
                alert(LOW_RATING_WO_MESSAGE)
            else
                alert(HIGH_RATING_WO_MESSAGE)
        }  
    } catch(err) {
        alert("Please select a rating.")
    }
}