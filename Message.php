<?php

class Message
{
    function throwErrorMessage($key)
    {
        switch ($key) {
            case 'password-strength':
                return 'Password should have at least 8 characters, one upper case letter, one number, and one special character.';

            case 'user-or-email-not-valid':
                return 'Sorry, the email or nickname already exists, please enter a new one.';

            case 'username-length':
                return 'Name must have between 3 and 8 characters.';
        }
    }
}