<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bilhete;
use Illuminate\Http\Request;

class BilheteController extends Controller
{

    public function use(Bilhete $bilhete)
    {
        $this->authorize('use', $bilhete);
        $bilhete->estado = 'usado';
        $bilhete->save();
        return redirect()->back()->with('success', __('Ticket is now marked as used'));
    }
}
