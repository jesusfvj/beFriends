const registerForm = document.querySelector(".form__container");
registerForm.addEventListener("submit", sendRegisterData);

function sendRegisterData(event){
    event.preventDefault();
    const formData = new FormData();
    formData.append("fullname", inputNameRegister.value);
    formData.append("username", inputUserRegister.value);
    formData.append("email", inputEmailRegister.value);
    formData.append("password", inputPasswordRegister.value);
    formData.append("gender", inputGenderRegister.value);

    fetch("./controllers/users/register.php" ,{
        method: "POST",
        body: formData
    })
    .then((res) => res.json())
    .then((data) => {

    });

}