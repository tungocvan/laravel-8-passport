@extends('layouts.app')
@php
  $options = [
    'email' => [
        'name' => 'username',
        'title' => 'Tên Đăng Nhập'
    ],
    'password' => [
        'name' => 'password',
        'title' => 'Mật khẩu',
        'type' => 'password'
    ],
];  

@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Thông tin đăng nhập') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>Đã có lỗi xãy ra. Vui lòng kiểm tra dữ liệu phía dưới.</strong>
                            </div>
                        @endif
          
                        <x-input-text :options="$options['email']"/>
                        <x-input-text :options="$options['password']"/>


                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ghi nhớ tài khoản') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng nhập') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-8 offset-md-4 mt-5">       
                            <a href="{{route('auth.facebook')}}" class="btn btn-primary mr-5">Login With Facebook</a>                       
                            <a href="{{route('auth.google')}}" class="btn btn-primary">Login With Google</a>
                            <a href="{{route('auth.zalo')}}" class="btn btn-primary">Zalo</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
