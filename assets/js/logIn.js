window.history.forward();

function preventBack() {
    window.history.forward(); 
}
  
setTimeout("preventBack()", 0);
  
window.onunload = function () { null };

const inputUserLogIn = document.querySelector("#inputUserLogIn");
const inputPasswordLogIn = document.querySelector("#inputPasswordLogIn");
const logInForm = document.querySelector("#formContainerLogIn");
const registerText = document.querySelector(".paragraph-register__text");
const showParagraph = document.querySelectorAll(".paragraph-show__text");
const errorLoginAlert = document.querySelector(".modal-error-login__div");
const facebookText = document.querySelector(".facebook__text");
const facebookIcon = document.querySelector(".facebook__icon");
const forgotText = document.querySelector(".paragraph-forgot__text");

const spinner = document.querySelector(".spinner");

const iconsImg = document.querySelectorAll(".icons__img");
const comingSoonAlert = document.querySelector(".modal-coming-soon__div");

facebookText.addEventListener("click", showUnderConstModal);
facebookIcon.addEventListener("click", showUnderConstModal);
forgotText.addEventListener("click", showUnderConstModal);

iconsImg.forEach((element) => {
  element.addEventListener("click", showUnderConstModal);
});

registerText.addEventListener("click", sendToRegister);

logInForm.addEventListener("submit", sendLogInData);

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

function sendToRegister() {
  window.location = "./register.php";
}

function sendLogInData(event) {
  event.preventDefault();
  spinner.removeAttribute('hidden');
  const formData = new FormData();
  inputUserLogIn.value.includes("@")
    ? (formData.append("email", inputUserLogIn.value),
      formData.append("username", ""))
    : (formData.append("username", inputUserLogIn.value),
      formData.append("email", ""));
  formData.append("password", inputPasswordLogIn.value);
  fetch("./controllers/users.php?controller=login", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data[0] === true) {
        localStorage.setItem("userId", JSON.stringify(data.userId));
        window.location = "./feed.php";
      } else {
        modalVerificationsLogin();
      }
      spinner.setAttribute('hidden', '');
    });
}

function showUnderConstModal(){
  comingSoonAlert.style.display = "block";
    setTimeout(() => {
      comingSoonAlert.style.display = "none";
    }, 2000);
}

function modalVerificationsLogin(){
  errorLoginAlert.style.display = "block";
    setTimeout(() => {
      errorLoginAlert.style.display = "none";
    }, 3000);
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
