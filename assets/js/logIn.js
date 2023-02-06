const inputUserLogIn = document.querySelector("#inputUserLogIn");
const inputPasswordLogIn = document.querySelector("#inputPasswordLogIn");
const logInForm = document.querySelector("#formContainerLogIn");
const registerText = document.querySelector(".paragraph-register__text");
const showParagraph = document.querySelectorAll(".paragraph-show__text");

registerText.addEventListener("click", sendToRegister);

logInForm.addEventListener("submit", sendLogInData);

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

function sendToRegister(){
  window.location="./register.php";
}

function sendLogInData(event) {
  event.preventDefault();
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
      console.log(data);
      if (data[0] === true) {
        localStorage.setItem("userId", JSON.stringify(data.userId));
        window.location = "./feed.php";
      } else {
        console.log("bad");
      }
    });
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