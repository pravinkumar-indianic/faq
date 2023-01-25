<?php

namespace Indianic\EmailTemplate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    /**
     * @desc Get faq associated with the state.
     * 
     * @return object
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
