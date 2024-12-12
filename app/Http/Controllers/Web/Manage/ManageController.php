<?php

namespace App\Http\Controllers\Web\Manage;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with([
            'buyer',
            'belongsToUser',
            'shirts',
            'purchase'
        ])->paginate(10);

        $shirtSizes = ['P' => 0, 'M' => 0, 'G' => 0, 'GG' => 0, 'XG' => 0];

        foreach ($tickets as $ticket) {
            foreach ($ticket->shirts as $shirt) {
                $size = $shirt->size;
                if (isset($shirtSizes[$size])) {
                    $shirtSizes[$size]++;
                }
            }
        }

        return view('manage', [
            'tickets' => $tickets,
            'shirtSizes' => $shirtSizes,
        ]);
    }

}
