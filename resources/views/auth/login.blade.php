@extends('layout')

@section('title', 'Вход')

@section('content')
<div class="container py-5" style="max-width: 400px;">
    <h1 class="mb-4 text-center">Вход</h1>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-primary">Войти</button>
            <a href="{{ route('register.form') }}" class="btn btn-secondary">Регистрация</a>
        </div>
    </form>
</div>
@endsection
