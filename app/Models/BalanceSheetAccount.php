<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceSheetAccount extends Model
{
    //
    protected $table = "balance_sheet_accounts";
    public $primaryKey = 'account_name';
    public $incrementing = false;
    //protected $primaryKey;

    public function account()
    {
    	//$this->primaryKey = 'account_name';
    	return $this->hasMany("App\Models\GeneralLedgerTransactions", 'account_name', 'account_name');
    }
    /*public function listAccounts()
    {
    	return $this->all();
    }*/


}