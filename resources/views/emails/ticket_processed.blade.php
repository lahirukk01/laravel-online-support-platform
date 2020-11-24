@component('mail::message')
    <div>
        <h2>Your ticket has been processed</h2>
        <ul style='margin-bottom: 20px;'>
            <li>Customer Name: {{ $ticket->customer_name }}</li>
            <li>Email: {{ $ticket->email }}</li>
            <li>Telephone: {{ $ticket->telephone }}</li>
            <li>Reference Number: {{ $ticket->reference_number }}</li>
        </ul>
        <p>Please visit site and check ticket status</p>
    </div>

@component('mail::button', ['url' => route('home')])
Check Status
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
