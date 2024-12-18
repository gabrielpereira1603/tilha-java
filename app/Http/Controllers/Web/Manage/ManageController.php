<?php

namespace App\Http\Controllers\Web\Manage;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index(Request $request)
    {
        // Paginação apenas para os tickets
        $tickets = Ticket::with([
            'buyer',
            'belongsToUser',
            'shirts',
            'purchase'
        ])->paginate(10);

        $shirtSizes = ['PP' => 0, 'P' => 0, 'M' => 0, 'G' => 0, 'GG' => 0, 'XG' => 0];

        $totalShirts = 0;

        foreach ($tickets as $ticket) {
            foreach ($ticket->shirts as $shirt) {
                $size = $shirt->size;
                if (isset($shirtSizes[$size])) {
                    $shirtSizes[$size]++;
                }
                $totalShirts++;
            }
        }

        return view('manage', [
            'tickets' => $tickets,
            'shirtSizes' => $shirtSizes,
            'totalShirts' => $totalShirts,
        ]);
    }


}
