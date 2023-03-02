<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtleastOneOfArray implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
     
        $found = false;
        // ensure one in array of items
        foreach($value as $k=>$val){
            
            if($val !== false) {
                $found = true;
            }
        }

        if($found == false){
            $fail('You must set a timeframe for driving!');
        }
    }
}
