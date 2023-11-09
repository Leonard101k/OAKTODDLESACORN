function validateForm() {
    var form = document.getElementById('enrollmentForm');
    var inputs = form.getElementsByTagName('input');
    var valid = true;

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].hasAttribute('required') && !inputs[i].value) {
            valid = false;
            alert('Please fill out all required fields.');
            break;
        }
    }

    if (valid) {
        form.submit();
    }
}