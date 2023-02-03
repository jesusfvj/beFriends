const showParagraph = document.querySelectorAll(".paragraph-show__text");
const passwordAlert = document.querySelector(".password-verification__div--display");
const sucessAlert = document.querySelector(".modal-success-register__div");
const errorAlert = document.querySelector(".modal-error-register__div");

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

const registerForm = document.querySelector(".form__container");
registerForm.addEventListener("submit", sendRegisterData);

function sendRegisterData(event) {
  event.preventDefault();
  if (inputPasswordRepeat.value === inputPasswordRegister.value) {
    const formData = new FormData();
    formData.append("fullname", inputNameRegister.value);
    formData.append("username", inputUserRegister.value);
    formData.append("email", inputEmailRegister.value);
    formData.append("password", inputPasswordRegister.value);
    formData.append("gender", inputGenderRegister.value);
    fetch("./controllers/users/register.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data[0] === true) {
          sucessAlert.style.display = "block";

          setTimeout(() => {
            sucessAlert.style.display = "none";
          }, 2000);
          setTimeout(() => {
            window.location.href = "./index.php";
          }, 2200);
          
        } else{
          errorAlert.style.display = "block";

          setTimeout(() => {
            errorAlert.style.display = "none";
          }, 3000);
        }
      });


  } else {
    showPasswordVerification();
  }

}

function showPasswordVerification() {
  passwordAlert.style.display = "block";
  window.addEventListener("click", () => {
    passwordAlert.style.display = "none";
  })
}

function togglePassword(event) {
  const clickedShow = document.querySelector("#" + event.target.id);
  const clickedInput = document.querySelector(
    "#" + event.target.nextElementSibling.id
  );
  clickedInput.type == "password"
    ? ((clickedInput.type = "text"),
      (clickedShow.textContent = "Hide"),
      (clickedShow.style.color = "rgb(161, 161, 161)"))
    : ((clickedInput.type = "password"),
      (clickedShow.textContent = "Show"),
      (clickedShow.style.color = "black"));
}
