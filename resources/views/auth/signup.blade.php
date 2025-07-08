<x-guest-layout className="page-signup" title="Signup">
    <form action="{{ route('signup') }}" method="POST">
        @csrf
        <div class="form-group">
            <input name="name" type="text" placeholder="Name" value="{{ old('name') }}" />
        </div>
        <div class="form-group">
            <input name="email" type="email" placeholder="Your Email" value="{{ old('email') }}" />
        </div>
        <div class="form-group">
            <input name="password" type="password" placeholder="Your Password" />
        </div>
        <div class="form-group">
            <input name="password_confirmation" type="password" placeholder="Repeat Password" />
        </div>
        <hr />
        <div class="form-group">
            <input name="phone" type="text" placeholder="Phone" />
        </div>
        <button type="submit" class="btn btn-primary btn-login w-full">Register</button>
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
            Already have an account? -
            <a href="{{ route('show.signin') }}"> Click here to login </a>
        </div>
    </x-slot:footerLinks>
</x-guest-layout>
