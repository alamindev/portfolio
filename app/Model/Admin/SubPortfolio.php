<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class SubPortfolio extends Model
{
    public function Portfolios()
    {
        return  $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }
}
