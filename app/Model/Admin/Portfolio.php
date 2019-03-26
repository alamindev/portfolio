<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function subPortfolios()
    {
        return  $this->hasMany(SubPortfolio::class, 'portfolio_id', 'id');
    }
}
