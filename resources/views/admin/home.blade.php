@extends('layouts.app')

@section('my_styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/sp-1.2.1/datatables.min.css"/>
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

    <div class='table-responsive'>
        <h4 class='text-center'>Agents</h4>
        <table id='agents-table' class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agents as $agent)
                <tr>
                    <td>{{ $agent->name }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>{{ $agent->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <hr>

    <div class='row my-5'>
        <div class='col-md-8 offset-md-2'>
            <h4 class='text-center'>Create agent</h4>
            @if(session('status'))
            <div class='text-success'>
                {{ session('status') }}
            </div>
            @endif
            <form action='{{ route('create_agent') }}' method='post'>
                @csrf
                <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' class='form-control @error('name') border border-danger @enderror'
                           name='name' required maxlength='50' value='{{ old('name') }}'>
                    @error('name')
                    <div class='text-danger'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class='form-group'>
                    <label for='email'>Email</label>
                    <input type='email' class='form-control @error('email') border border-danger @enderror'
                           name='email' required maxlength='50' value='{{ old('email') }}'>
                    @error('email')
                    <div class='text-danger'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='password' class='form-control @error('password') border border-danger @enderror'
                           name='password' required maxlength='20'>
                    @error('password')
                    <div class='text-danger'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class='form-group'>
                    <label for='confirm-password'>Password Confirm</label>
                    <input type='password' class='form-control @error('password_confirmation') border border-danger @enderror'
                           name='password_confirmation' required maxlength='20'>
                    @error('password_confirmation')
                    <div class='text-danger'>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <button type='submit' class='btn btn-primary'>Create Agent</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('my_scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/sp-1.2.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#agents-table').DataTable()
        })
    </script>
@endsection
