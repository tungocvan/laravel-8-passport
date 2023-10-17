<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    use HasFactory;
   //protected $connection = 'wordpress';
    protected $table = 'nbw_term_taxonomy';
    protected $primaryKey = "term_taxonomy_id";
    public $timestamps = false; 
}
