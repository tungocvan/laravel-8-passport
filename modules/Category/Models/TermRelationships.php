<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermRelationships extends Model
{
    use HasFactory;
   //protected $connection = 'wordpress';
    protected $table = 'nbw_term_relationships';
    protected $primaryKey = "term_taxonomy_id";    
    public $timestamps = false;  
    public function TermTaxonomy()
    {
        return $this->belongsTo(TermTaxonomy::class, 'term_taxonomy_id');
    }
}
