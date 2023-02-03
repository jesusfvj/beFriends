const inputUserLogIn = document.querySelector("#inputUserLogIn");
const inputPasswordLogIn = document.querySelector("#inputPasswordLogIn");

logInForm.addEventListener("submit", sendLogInData);

function sendLogInData(event) {
  event.preventDefault();
    const formData = new FormData();
    inputUserLogIn.value.includes("@")
    ?(formData.append("email", inputUserLogIn.value), formData.append("username", ""))
    :(formData.append("username", inputUserLogIn.value), formData.append("email", ""));
    formData.append("password", inputPasswordLogIn.value);
    fetch("./controllers/users/logIn.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data)
        if(data[0]===true){
          window.location = "./feed.php";
        } else {
            console.log("bad")
        }
      });
}