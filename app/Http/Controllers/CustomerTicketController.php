<?php

namespace App\Http\Controllers;

use App\Mail\TicketSubmitted;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerTicketController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required|max:1000',
            'email' => 'required|email|max:50',
            'telephone' => 'required|digits_between:9,14'
        ]);

        $referenceNumber = uniqid('osp-');

        $ticket = Ticket::create([
            'customer_name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'description' => $request->description,
            'reference_number' => $referenceNumber
        ]);

        Mail::to($ticket->email)->queue(new TicketSubmitted($ticket));

        return view('confirmation', ['ticket' => $ticket]);
    }

    public function show(Request $request) {
        $this->validate($request, [
            'reference' => 'required|max:50'
        ]);

        $ticket = Ticket::where('reference_number', $request->reference)->first();
        return view('status', ['ticket' => $ticket]);
    }
}
