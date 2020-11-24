@extends('layouts.app')

@section('content')
<div class='container-fluid'>
    <div class='row my-3'>
        <div class='col-md-6 offset-md-3'>
            <h2 class='text-center'>Welcome to online support platform</h2>
        </div>
    </div>
    <div class='row mb-3 jumbotron'>
        <div class='col-md-8 offset-md-2'>
            <h4 class='text-center text-primary'>Create new ticket</h4>
            <form action='{{ route('create_ticket') }}' method='post'>
                @csrf
                <div class='form-group'>
                    <label for='firstname'>Customer Name</label>
                    <input type='text' class='form-control @error('name') border border-danger @enderror'
                           name='name' required value='{{ old('name') }}'>
                    @error('name')
                    <div class='text-danger text-sm'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>

                <div class='form-group'>
                    <label for='problem-description'>Problem Description</label>
                    <textarea class='form-control @error('description') border border-danger @enderror' rows='5'
                              name='description' required maxlength='1000'>{{ old('description') }}</textarea>
                    @error('description')
                    <div class='text-danger text-sm'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>

                <div class='form-group'>
                    <label for='email'>Email address</label>
                    <input type='email' class='form-control @error('email') border border-danger @enderror'
                           name='email' required value='{{ old('email') }}'>
                    @error('email')
                    <div class='text-danger text-sm'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>

                <div class='form-group'>
                    <label for='phone'>Phone Number</label>
                    <input type='tel' class='form-control @error('telephone') border border-danger @enderror'
                           name='telephone' required value='{{ old('telephone') }}'>
                    @error('telephone')
                    <div class='text-danger text-sm'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>

                <button type='submit' class='btn btn-primary'>Create Ticket</button>
            </form>
        </div>
    </div>
    <hr>
    <div class='row mb-3'>
        <div class='col-md-6 offset-md-3'>
            <h4 class='text-center text-info'>View ticket status</h4>
            <form action='{{ route('check_status') }}' method='post'>
                @csrf
                <div class='form-group'>
                    <label for='reference'>Reference Number</label>
                    <input type='text' class='form-control @error('reference') border border-danger @enderror'
                           name='reference' required>
                </div>
                @error('reference')
                <div class='text-danger mt-2 text-sm'>
                    {{ $message }}
                </div>
                @enderror
                <button type='submit' class='btn btn-primary'>View Status</button>
            </form>
        </div>
    </div>
</div>
@endsection

