<?php

namespace App\Http\Controllers\Web\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyTicketsController extends Controller
{
    public function viewMyTickets(Request $request)
    {
        $user = $request->user();

        $tickets = $user->ticketsOwned()
            ->orWhereIn('id', $user->ticketsBought()->pluck('id'))
            ->with([
                'buyer',
                'belongsToUser',
                'shirts',
                'purchase'
            ])
            ->get();
        return view('dashboard', compact('tickets'));
    }



}
