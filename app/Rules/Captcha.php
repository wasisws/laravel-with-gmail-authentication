<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use ReCaptcha\ReCaptcha;

class Captcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET'));

        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);

        if ($response->isSuccess()) {
        } else {
            $errors = $response->getErrorCodes();

            $fail('Please complete the reCAPTCHA to submit form.');
        }
    }

}
