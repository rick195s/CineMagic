<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bilhete;
use App\Models\Sessao;
use Illuminate\Http\Request;

class BilheteController extends Controller
{

    public function use(Request $request, Bilhete $bilhete)
    {
        $validatedData = $request->validate([
            'sessao_id' => 'required|exists:sessoes,id',
        ]);
        //$this->authorize('use', [$bilhete, $validatedData['sessao_id']]);
        $bilhete->estado = 'usado';
        $bilhete->save();

        return $request->wantsJson()
            ? response()->json([
                'message' =>  __('Ticket is now marked as used'),
            ])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            : back()->with('success', __('Ticket is now marked as used'));
    }
}
