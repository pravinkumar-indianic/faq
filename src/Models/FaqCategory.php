<?php

namespace Indianic\FAQManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class FaqCategory extends Model
{
    use HasFactory;
    use HasUlids;

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
