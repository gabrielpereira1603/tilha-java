<?php

namespace App\Http\Controllers\Web\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketsController extends Controller
{
    public function viewBuyTicket(Request $request): View
    {
        $availableTickets = Ticket::availableForUser($request->user()->id)->get();

        return view('buy-ticket', [
            'user' => $request->user(),
            'availableTickets' => $availableTickets,
        ]);
    }

}
