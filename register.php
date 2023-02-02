<!DOCTYPE html>
<html class="html__container--background-image" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time(); ?>">
    <script src="./assets/js/script.js?v=<?php echo time(); ?>" defer></script>
    <script src="./assets/js/register.js?v=<?php echo time(); ?>" defer></script>
    <title>beFriends - register</title>
</head>
<body>
    <header></header>
    <main class="main__container">
        <section class="section__container">
            <section class="section-first-body__container">
                <img class="section__img--size" src="./assets/images/logoBeFriends.png" alt="logo beFriends">
                <form class="form__container">
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">User</p>
                        <input class="form__input" id="inputUserRegister" type="text" name="inputUserRegister" required>
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Name</p>
                        <input class="form__input" id="inputNameRegister" type="text" name="inputNameRegister" required>
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Email</p>
                        <input class="form__input" id="inputEmailRegister" type="email" name="inputEmailRegister" required>
                    </div>
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">Gender</p>
                        <select class="form__input" id="inputGenderRegister" type="text" name="inputGenderRegister" required>
                        <option></option select>
                        <option>Female</option>
                        <option>Male</option>
                        <option>Non binary</option>
                        <option>Doesn't apply</option>
                        </select>
                    </div>
                    <div class="form-div__input">
                        <p id="show2" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordRegister" type="password" name="inputPasswordRegister" required>
                        <p class="paragraph-placeholder__text">Password</p>
                    </div>
                    <div class="form-div__input">
                        <p id="show3" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordRepeat" type="password" name="inputPasswordRepeat" required>
                        <p class="paragraph-placeholder__text">Repeat Password</p>
                    </div>
                    <input type="submit" class="form__button" value="Register">
                </form>
                
            </section>
            <section class="section-third-body__container">
                <p class="paragraph-download__text" >Download the app</p>
                <div class="div-app-icons__container">
                    <img class="icons__img" src="./assets/images/appIcon.png" alt="App store download icon">
                    <img class="icons__img" src="./assets/images/googlePlayIcon.png" alt="Google Play store download icon">
                </div>
            </section>
        </section>
    </main>
    <footer></footer>
</body>
</html>