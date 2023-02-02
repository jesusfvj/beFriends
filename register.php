<!DOCTYPE html>
<html class="html__container--background-image" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./script.js" defer></script>
    <title>beFriends</title>
</head>
<body>
    <header></header>
    <main class="main__container">
        <section class="section__container">
            <section class="section-first-body__container">
                <img class="section__img--size" src="./assets/logoBeFriends.png" alt="logo beFriends">
                <form class="form__container">
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">User</p>
                        <input class="form__input" id="inputUserRegister" type="text" name="inputUserRegister">
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Name</p>
                        <input class="form__input" id="inputNameRegister" type="text" name="inputNameRegister">
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Email</p>
                        <input class="form__input" id="inputEmailRegister" type="email" name="inputEmailRegister">
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Gender</p>
                        <input class="form__input" id="inputGenderRegister" type="text" name="inputGenderRegister">
                    </div>
                    <div class="form-div__input">
                        <p id="show2" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordRegister" type="password" name="inputPasswordRegister">
                        <p class="paragraph-placeholder__text">Password</p>
                    </div>
                    <div class="form-div__input">
                        <p id="show3" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordRepeat" type="password" name="inputPasswordRepeat">
                        <p class="paragraph-placeholder__text">Repeat Password</p>
                    </div>
                    <button class="form__button">Register</button>
                </form>
                
            </section>
            <section class="section-third-body__container">
                <p class="paragraph-download__text" >Download the app</p>
                <div class="div-app-icons__container">
                    <img class="icons__img" src="./assets/appIcon.png" alt="App store download icon">
                    <img class="icons__img" src="./assets/googlePlayIcon.png" alt="Google Play store download icon">
                </div>
            </section>
        </section>
    </main>
    <footer></footer>
</body>
</html>