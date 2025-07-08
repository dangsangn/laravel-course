<x-guest-layout className="page-login" title="Login">
    <form action="{{ route('signin') }}" method="POST">
        @csrf
        <div class="form-group">
            <input name="email" type="email" placeholder="Your Email" value="{{ old('email') }}" />
        </div>
        <div class="form-group">
            <input name="password" type="password" placeholder="Your Password" />
        </div>
        <div class="text-right mb-medium">
            <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>
        </div>

        <button type="submit" class="btn btn-primary btn-login w-full">Login</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <x-slot:footerLinks>
        <div class="login-text-dont-have-account">
            Don't have an account? -
            <a href="{{ route('show.signup') }}"> Click here to create one</a>
        </div>
    </x-slot:footerLinks>
</x-guest-layout>
