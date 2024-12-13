<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="{{ asset('responsive-login/style.css') }}" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <div class="item">
                <img src="{{ asset('responsive-login/img/mountain.jpg') }}" alt="">
                <div class="content">
                    <div class="author"></div>
                    <div class="title"></div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('responsive-login/img/autumn.jpg') }}" alt="">
                <div class="content">
                    <div class="author"></div>
                    <div class="title"></div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('responsive-login/img/winter.jpg') }}" alt="">
                <div class="content">
                    <div class="author"></div>
                    <div class="title"></div>
                </div>
            </div>
        </div>
        <div class="thumbnail">
            <div class="item">
                <img src="{{ asset('responsive-login/img/autumn.jpg') }}">
                <div class="content">
                    <div class="title">
                        Autumn
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('responsive-login/img/winter.jpg') }} ">
                <div class="content">
                    <div class="title">
                        Winter
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('responsive-login/img/mountain.jpg') }} ">
                <div class="content">
                    <div class="title">
                        Spring
                    </div>
                </div>
            </div>
        </div>
        <div class="arrows">
            <button id="prev">
                < </button>

                    <button id="next"> > </button>
        </div>
        <div class="time"></div>

        <section class="container">
            <div class="form-box login">
                <form action="{{ route('storelogin') }}" method="POST">
                    @csrf

                    <h1>Login</h1>

                    <!-- Username or Email -->
                    <div class="input-box">
                        <input type="text" placeholder="Username" name="email" value="{{ old('email') }}">
                        <i class='bx bxs-user'></i>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password">
                        <i class='bx bxs-lock-alt'></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="bottom">
                        <!-- Remember this device -->
                        <div class="checkbox">
                            <input type="checkbox" id="remember-device" name="remember">
                            <label for="remember-device">Remember this device</label>
                        </div>

                        <!-- Forgot Password link -->
                        <div class="forgot-link">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn">Login</button>
                </form>

            </div>
            <div class="form-box register">
                <form method="POST" action="{{ route('storeregis') }}">
                    @csrf
                    
                    <h1>Registration</h1>
                    <div class="input-box">
                        <input type="text" placeholder="Username" for="name" id="name" name="name">
                        <i class='bx bxs-user'></i>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="Email" for="email" id="email" name="email">
                        <i class='bx bxs-envelope'></i>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" for="password" id="password" name="password">
                        <i class='bx bxs-lock-alt'></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirm Password" for="password_confirmation"
                            id="password_confirmation" name="password_confirmation">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>

            <div class="toggle-box">
                <div class="toggle-panel toggle-left">
                    <h1>Hello, Welcome</h1>
                    <br>
                    <p>Don't have an Account?</p>
                    <button class="btn register-btn">Register</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <br>
                    <p>Already have an Account?</p>
                    <button class="btn login-btn">Login</button>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('responsive-login/script.js') }}"></script>
</body>

</html>
