@extends('auth.layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}" class="col-lg-6 col-md-8 col-10 mx-auto">
    @csrf
    <div class="mx-auto text-center my-4">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
            </svg>
        </a>
        <h2 class="my-3">Register</h2>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="firstname">Firstname</label>
            <input id="firstname" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="lastname">Lastname</label>
            <input id="lastname" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address">
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="city">City</label>
            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city">
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="state">State</label>
            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" autocomplete="state">
            @error('state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="country">Country</label>
            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" autocomplete="country">
            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="zipcode">Zipcode</label>
        <input id="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" autocomplete="zipcode">
        @error('zipcode')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @php
        $roles = \App\Models\Role::where('status', 1)->get();
        $packages = \App\Models\Package::where('status', 1)->get();
        $vendors = \App\Models\Vendor::with('user')->where('status', 1)->get();
    @endphp
    <div class="form-group">
        <label for="role">Role</label>
        <select id="role" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                @if($role->name !== 'Admin')
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endif
            @endforeach
        </select>
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group" id="package_input" style="display: none;">
        <label for="package">Package</label>
        <select id="package" class="form-control @error('package_id') is-invalid @enderror" name="package_id">
            <option value="">Select Package</option>
            @foreach($packages as $package)
                <option value="{{ $package->id }}">{{ $package->title }}</option>
            @endforeach
        </select>
        @error('package_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group" id="vendors_input" style="display: none;">
        <label for="vendor">Vendors</label>
        <select id="vendor" class="form-control @error('vendor_id') is-invalid @enderror" name="vendor_id">
            <option value="">Select vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}">{{ $vendor->user->first_name . ' ' . $vendor->user->last_name}}</option>
            @endforeach
        </select>
        @error('vendor_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Register') }}</button>
    <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
</form>
@endsection

@section('bottom_script')
    <script>
        document.getElementById('role').addEventListener('change', function() {
            var role = this.value;
            if (role == 2) {
                document.getElementById('package_input').style.display = 'block';
                document.getElementById('vendors_input').style.display = 'none';
            } else if (role == 3) {
                document.getElementById('package_input').style.display = 'none';
                document.getElementById('vendors_input').style.display = 'block';
            } else {
                document.getElementById('package_input').style.display = 'none';
                document.getElementById('vendors_input').style.display = 'none';
            }
        });
    </script>
@endsection
