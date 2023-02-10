const showParagraph = document.querySelectorAll(".paragraph-show__text");
const passwordAlert = document.querySelector(".password-verification__div--display");
const sucessAlert = document.querySelector(".modal-success-register__div");
const errorAlert = document.querySelector(".modal-error-register__div");
const logInText = document.querySelector(".paragraph-log-in__text");
const registerForm = document.querySelector("#formContainerRegister");
const registerErrorMessage = document.getElementById('registerError');

const spinner = document.querySelector(".spinner");

const iconsImg = document.querySelectorAll(".icons__img");
const comingSoonAlert = document.querySelector(".modal-coming-soon__div");


iconsImg.forEach((element) => {
  element.addEventListener("click", showUnderConstModal);
});

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

registerForm.addEventListener("submit", sendRegisterData);

logInText.addEventListener("click", sendToLogIn);

function showUnderConstModal(){
  comingSoonAlert.style.display = "block";
    setTimeout(() => {
      comingSoonAlert.style.display = "none";
    }, 2500);
}

function sendToLogIn(){
  window.location="./index.php";
}

function sendRegisterData(event) {
  event.preventDefault();
  spinner.removeAttribute('hidden');
  if (inputPasswordRepeat.value === inputPasswordRegister.value) {
    const formData = new FormData();
    formData.append("fullname", inputNameRegister.value);
    formData.append("username", inputUserRegister.value);
    formData.append("email", inputEmailRegister.value);
    formData.append("password", inputPasswordRegister.value);
    formData.append("gender", inputGenderRegister.value);
    fetch("./controllers/users.php?controller=register", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data[0] && data[0] == 'password-strength') {
          registerErrorMessage.textContent = data[1];
        } else if (data[0] && data[0] == 'user-or-email-not-valid') {
          registerErrorMessage.textContent = data[1];
        } else if (data[0] && data[0] == 'username-length') {
          registerErrorMessage.textContent = data[1];
        }
        modalVerifications(data);
        spinner.setAttribute('hidden', '');
      });
  } else {
    showPasswordVerification();
    spinner.setAttribute('hidden', '');
  }
}

function modalVerifications(data){
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
    }, 4000);
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
