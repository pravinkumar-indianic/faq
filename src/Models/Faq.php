<?php

namespace Indianic\FAQManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Faq extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * @desc Get category associated with the state.
     * 
     * @return object
     */
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
