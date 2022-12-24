<?php

namespace App\Http\Controllers;

use App\Models\Approve;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApproveController extends Controller
{
    public function approvel($company_id)
    {
        $approuve = new Approve();
        $approuve->company_fk_id = $company_id;
        $approuve->approuve_date = Carbon::now()->toDateString();

        if ($approuve->save()) {
            return true;
        } else {
            return false;
        }
    }
}
