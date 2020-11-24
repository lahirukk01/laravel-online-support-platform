@extends('layouts.app')

@section('my_styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/sp-1.2.1/datatables.min.css"/>
    <script src="https://use.fontawesome.com/4509bc17a4.js"></script>
@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('content')
<div class='container-fluid'>
    <div class='row my-3'>
        <div class='col-md-8 offset-md-2'>
            <h3 class='text-center'>Welcome {{ $user->name }}</h3>
        </div>
    </div>

    <div class="table-responsive">
        <table id='tickets-table' class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Reference</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket-> customer_name}}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->telephone }}</td>
                        <td>{{ $ticket->reference_number }}</td>
                        <td ticket-id='{{ $ticket->id }}'><i class='fa fa-check'
                                                             style='display: @if($ticket->opened)inline @else none @endif;'></i>
                            <button class='btn btn-info view-ticket pull-right'>View</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <div class="modal fade" id="ticket-modal" tabindex="-1" aria-labelledby="ticket-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="ticket-modal-title">Ticket Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='ticket-details'></div>
                    <form id='reply-form' action='#' method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="reply">Reply</label>
                            <textarea class="form-control" id="reply-textarea" rows="5" required></textarea>
                        </div>
                        <button id='submit-button' type="submit" class="btn btn-primary">Submit</button>
                        <div id='spinner' class="spinner-border text-primary pull-right" role="status" style='display: none;'>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('my_scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/sp-1.2.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tickets-table').DataTable({
            ordering: false
        })

        let $siblingIcon = undefined

        $('#tickets-table .view-ticket').click(function(e) {
            console.log('Button clicked')
            const ticketId = $(this).parent().attr('ticket-id')
            const data = {
                _token: '{{ @csrf_token() }}',
                ticketId
            }

            $siblingIcon = $(this).siblings('i')

            const $modal = $('#ticket-modal')
            const $ticketDetails = $modal.find('.ticket-details')
            $ticketDetails.empty()

            $.get('{{ route('agent_show_ticket') }}', data, result => {
                if (!result) {
                    alert('Failed to fetch ticket details');
                } else {
                    const ticket = JSON.parse(result);
                    console.log(ticket)
                    const modalBody = `
                    <ul style='margin-bottom: 20px;'>
                        <li>Customer Name: ${ticket.customer_name}</li>
                        <li>Email: ${ticket.email}</li>
                        <li>Telephone: ${ticket.telephone}</li>
                        <li>Reference Number: ${ticket.reference_number}</li>
                    </ul>
                    <p style='text-align: justify;'>Description: ${ticket.description}</p>`
                    $ticketDetails.append(modalBody)
                    $('#reply-textarea').val(ticket.agent_reply)
                    $('#reply-form').attr('ticket-id', ticketId)
                    $modal.modal()
                }
            })
        })

        $('#reply-form').submit(function(e) {
            e.preventDefault()
            $('#submit-button').prop('disabled', true)
            const reply = $('#reply-textarea').val().trim()
            console.log(reply)

            if (!reply || reply === '') {
                return false
            }

            const ticketId = $('#reply-form').attr('ticket-id')
            const data = {
                _token: '{{ @csrf_token() }}',
                ticketId,
                reply
            }

            $('#spinner').show()

            $.post('{{ route('agent_reply') }}', data, result => {
                $('#spinner').hide()
                $('#submit-button').prop('disabled', false)
                $('#ticket-modal').modal('hide')

                if (result.status === 'success') {
                    alert('Agent reply submitted successfully')
                    $siblingIcon.show()
                } else {
                    alert('Failed to submit agent reply')
                }
            })
        })
    })
</script>
@endsection
