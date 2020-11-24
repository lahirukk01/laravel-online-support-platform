@extends('layouts.app')

@section('content')
<div class='container-fluid'>
    <div class='row mt-5'>
        <div class='col-md-8 offset-md-2'>
            <h2 class='text-center'>Your ticket was successfully submitted.</h2>
            <ul style='margin-bottom: 20px;'>
                <li>Customer Name: {{ $ticket->customer_name }}</li>
                <li>Email: {{ $ticket->email }}</li>
                <li>Telephone: {{ $ticket->telephone }}</li>
                <li>Reference Number: {{ $ticket->reference_number }}</li>
            </ul>
            <p style='text-align: justify;'>{{ $ticket->description }}</p>
            <p>Check your email for the confirmation email. Once the ticket has been processed you will get an email alert. Check status of the ticket using the above
                mentioned reference number.</p>

            <button id='to-home-page-button' class='btn btn-primary'>Go Back To Home Page</button>
        </div>
    </div>
</div>
@endsection

@section('my_scripts')

    <script>
        $(document).ready(() => {
            $('#to-home-page-button').click(function (e) {
                window.location.replace('{{ route('home') }}')
            })
        })
    </script>

@endsection
