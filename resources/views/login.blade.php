@extends("layout")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="form-group col-md-4 align-center">
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
            @if($errors->has('password'))
                <div class="alert alert-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <h2>Login</h2>
            <form action="/attempt_login" method="post">
                @csrf
                <label for="item">Username: </label> <br />
                <input type="text" name="name" value="" class="form-control" /> <br />
                <label for="item">Password: </label><br />
                <input type="password" name="password" value="" class="form-control" /> <br />
                <input type="submit" value="Login" class="form-control" /> <br>
            </form>
        </div>
    </div>
</div>
@endsection
