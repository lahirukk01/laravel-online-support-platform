@extends('layouts.app')

@section('content')
<div class='container-fluid'>
    <div class='row my-3'>
        <div class='col-md-8 offset-md-2'>
            <h1 class='text-center mb-5'>Online Support Platform</h1>
            <h3 class='text-center mb-2 text-info'>Login</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-8 offset-md-2'>
            @if(session('status'))
            <div class='text-danger'>
                {{ session('status') }}
            </div>
            @endif
            <form action='{{ route('login') }}' method='post'>
                @csrf
                <div class='form-group'>
                    <label for='email'>Email</label>
                    <input type='email' class='form-control @error('email') border border-danger @enderror'
                           name='email' required maxlength='50'>
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
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name='remember'>
                    <label class="form-check-label" for="remember-me">Remember me</label>
                </div>
                <button type='submit' class='btn btn-primary'>Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
