<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPK</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <h1 class="auth-title">Log in</h1>
            <p class="auth-subtitle mb-5">SISTEM INFORMASI PENCATATAN KAS</p>
            @if (session()->has('loginError'))
            <div class="alert alert-danger fade show">
                    {{ session('loginError') }}
            </div>
            @endif
            <form method="POST" action="/login">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" placeholder="EMAIL" autofocus required autocomplete="off" value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

    </div>
</body>

</html>
