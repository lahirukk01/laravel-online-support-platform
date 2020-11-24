@extends('layouts.app')

@section('content')
<div class='container-fluid'>
    <div class='row mt-5'>
        <div class='col-md-8 offset-md-2'>
            <h2 class='text-center'>Ticket Status</h2>
            @if(!$ticket)
                <h4 class='text-center my-5'>Invalid reference number</h4>
            @elseif($ticket && $ticket->opened)
                <h4 class='text-center'>Your ticket has been processed</h4>
                <ul style='margin-bottom: 20px;'>
                    <li>Customer Name: {{ $ticket->customer_name }}</li>
                    <li>Email: {{ $ticket->email }}</li>
                    <li>Telephone: {{ $ticket->telephone }}</li>
                    <li>Reference Number: {{ $ticket->reference_number }}</li>
                </ul>
                <p class='text-justify'>{{ $ticket->description }}</p>
                <hr>
                <h5>Reply: </h5>
                <p class='text-justify'>{{ $ticket->agent_reply }}</p>
            @else
                <h4 class='text-center'>Your ticket has not been processed yet</h4>
                <p class='text-center'>Please check again once you received the confirmation of process email.</p>
            @endif
        </div>
    </div>
</div>
@endsection
