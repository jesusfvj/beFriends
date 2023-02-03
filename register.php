<!DOCTYPE html>
<html class="html__container--background-image" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time(); ?>">
    <script src="./assets/js/register.js?v=<?php echo time(); ?>" defer></script>
    <title>beFriends - register</title>
</head>

<body>
    <header></header>
    <main class="main__container">
        <section class="section__container">
            <section class="section-first-body__container">
                <img class="section__img--size" src="./assets/images/logoBeFriends.png" alt="logo beFriends">
                <form id="formContainerRegister" class="form__container">
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
                        <div class="password-verification__div--display">
                            <div class="password-verification-square__div">

                            </div>
                            <div class="password-verification-content__div">
                                <img class="password-verification__image" src="./assets/images/alert.png" alt="alert-icon">
                                <p class="password-verification__paragraph">Both passwords must match</p>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="form__button" value="Register">
                </form>
            </section>
            <section class="section-second-body__container">
                <p>Go back to</p>
                <p class="paragraph-log-in__text">Log in</p>
            </section>
            <section class="section-third-body__container">
                <p class="paragraph-download__text">Download the app</p>
                <div class="div-app-icons__container">
                    <img class="icons__img" src="./assets/images/appIcon.png" alt="App store download icon">
                    <img class="icons__img" src="./assets/images/googlePlayIcon.png" alt="Google Play store download icon">
                </div>
            </section>
        </section>
    </main>
    <footer></footer>
    <section class="modal-success-register__section">
        <div class="modal-success-register__div">
            <div class="modal-success-register__header">
                <p class="modal-success-register__title">Sucess registration</p>
            </div>
            <div class="modal-success-register__content">
                <img src="./assets/images/okIcon.png">
                <p class="modal-success-register__paragraph">The registration has been a success.</p>
            </div>
        </div>
    </section>
    <section class="modal-error-register__section">
        <div class="modal-error-register__div">
            <div class="modal-error-register__header">
                <p class="modal-error-register__title">Error in registration</p>
            </div>
            <div class="modal-error-register__content">
                <img src="./assets/images/notOkIcon.png">
                <p class="modal-error-register__paragraph">Sorry, the email or nickname already exists, please enter a new one.</p>
            </div>
        </div>
    </section>
</body>

</html>