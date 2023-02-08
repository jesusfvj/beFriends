<?php

class Message
{
    function throwErrorMessage($key)
    {
        switch ($key) {
            case 'password-strength':
                return 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';

            case 'user-or-email-not-valid':
                return 'Sorry, the email or nickname already exists, please enter a new one.';
        }
    }
}