<!DOCTYPE html>
@extends('layout')
@section('content')
    <h1>Електронна адреса, яку потрібно підписати</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('subscribe') }}">
        @csrf
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Почтова адреса"
                   required maxlength="100" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Підписатися</button>
        </div>
    </form>
@endsection


