<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use DateTime;

class FromTimeGreater implements ValidationRule
{
    /**
     * Ensures datetime correct format from before to
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $values, Closure $fail): void
    {
        
        if($values){
            
            $from = new DateTime($values['from']);
            $to = new DateTime($values['to']);
            
            if($from >= $to){
                $fail('Time from must come before to!');
            }
            

        }

    }
}
