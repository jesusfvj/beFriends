const showParagraph = document.querySelectorAll(".paragraph-show__text");

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

const registerForm = document.querySelector(".form__container");
registerForm.addEventListener("submit", sendRegisterData);

function sendRegisterData(event) {
  event.preventDefault();
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
    .then((data) => {});
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
