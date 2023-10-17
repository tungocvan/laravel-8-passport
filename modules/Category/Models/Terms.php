<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\TermTaxonomy;

class Terms extends Model
{
    use HasFactory;
   //protected $connection = 'wordpress';   
    protected $table = 'nbw_terms';
    protected $primaryKey = "term_id";
    public $timestamps = false;  
    public function termTaxonomy()
    {
        return $this->hasOne(TermTaxonomy::class, 'term_id', 'term_id');
    }
}
