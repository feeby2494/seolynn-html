


const inputEmail = document.querySelector("#inputEmail");
const issueDesc = document.querySelector("#issueDesc");
const emailSubmit = document.querySelector("#emailSubmit");
const statusMessage = document.querySelector("#statusMessage");


/* 

Check Validation

*/

const forms = document.querySelectorAll('.needs-validation')

// block submisson from extra validation step
// Loop over them and prevent submission
Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
    if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

    form.classList.add('was-validated')
    }, false)
})

/* 

Form Helpers/ Flash Status Message

*/

const clearInput = () => {

    // clearing the input feilds
    inputEmail.value = "";
    issueDesc.value = "";
}

const flashStatusMessage = (message, error) => {
    //Before time out => show message
    statusMessage.innerHTML = message;
    if (error) {
        statusMessage.classList.add("alert", "alert-danger");
    } else {
        statusMessage.classList.add("alert", "alert-success");
        clearInput();
    }

    //want to have status message flash for 4 seconds; we clean after 4 sec
    setTimeout(() => {
        // clean up status message
        statusMessage.innerHTML = "";
        statusMessage.classList.remove("alert", "alert-success", "alert-danger");
    }, 2000)
    
}

/* 

Form Submission

*/

emailSubmit.addEventListener("click", (e) => {
    e.preventDefault();
    const inputEmailValue = inputEmail.value;
    const issueDescValue = issueDesc.value;
  
    const dataJson = {}
    dataJson["inputEmail"] = inputEmailValue;
    dataJson["issueDesc"] = issueDescValue;

    console.log(dataJson);

    if (inputEmailValue == "" && issueDescValue == "") {
        // both input feilds are empty
        flashStatusMessage("Both Email and Issue Desc are Required", true)

    } else if (inputEmailValue == "") {
        // missing email
        flashStatusMessage("Email is Required", true)
    } else if (issueDescValue == "") {
        // missing desc
        flashStatusMessage("Issue Desc is Required", true)
    } else {
        // Clear to send



        /*
        
            Continue sending post request

        */

        // Below is for local dev version
        // fetch("http://seolynn.localhost/api/email", {
        fetch("https://seolynn.com/api/tools/email", {
        method: "post",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },

        //make sure to serialize your JSON body
        body: JSON.stringify(dataJson)
        })
        .then( (response) => { 
            flashStatusMessage("Email Sent!", false)
        })
        .catch((err) => {
            console.error(`Fetch problem: ${err.message}`);
            flashStatusMessage(`${err.message}`, true)
        });
    }


});


