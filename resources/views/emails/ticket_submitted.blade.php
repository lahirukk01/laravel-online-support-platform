@component('mail::message')
    <div>
        <h2>Your ticket was successfully submitted.</h2>
        <ul style='margin-bottom: 20px;'>
            <li>Customer Name: {{ $ticket->customer_name }}</li>
            <li>Email: {{ $ticket->email }}</li>
            <li>Telephone: {{ $ticket->telephone }}</li>
            <li>Reference Number: {{ $ticket->reference_number }}</li>
        </ul>
        <p style='text-align: justify;'>{{ $ticket->description }}</p>
        <p>Once the ticket has been processed you will get an email alert. Check status of the ticket using the above
            mentioned reference number.</p>
    </div>

{{--@component('mail::button', ['url' => ''])--}}

{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
