const showParagraph = document.querySelectorAll(".paragraph-show__text");
const inputPassword = document.querySelectorAll(".input__password");

showParagraph.forEach(element => {
    element.addEventListener("click", showPassword);
});

function showPassword(event){
    const clickedShow = document.querySelector("#"+event.target.id);
    const clickedInput = document.querySelector("#"+event.target.nextElementSibling.id);
    clickedInput.type=='password'?(clickedInput.type='text', clickedShow.textContent="Hide", clickedShow.style.color="rgb(161, 161, 161)"):
        (clickedInput.type='password', clickedShow.textContent="Show", clickedShow.style.color="black");
}