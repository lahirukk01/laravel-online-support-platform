<?php

namespace App\Http\Controllers;

use App\Mail\TicketProcessed;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function index() {
        $tickets = Ticket::all();

        return view('agent.home', [
            'user' => Auth::user(),
            'tickets' => $tickets
        ]);
    }

    public function show(Request $request) {
        $ticketId = $request->ticketId;
        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return null;
        }

        return json_encode($ticket);
    }

    public function store(Request $request) {
        $ticketId = $request->ticketId;
        $reply = $request->reply;
        $agentId = Auth::user()->id;
        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return ['status' => 'failure'];
        }

        $ticket->user_id = $agentId;
        $ticket->agent_reply = $reply;
        $ticket->opened = true;
        $ticket->save();

        Mail::to($ticket->email)->queue(new TicketProcessed($ticket));
        return ['status' => 'success'];
    }
}
