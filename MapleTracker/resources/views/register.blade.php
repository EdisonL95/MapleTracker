@extends("layout")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="form-group col-md-4 align-center">
            <h2>Register Page</h2>
            <form action="/attempt_register" method="post">
                @csrf
                <label for="item">Username: </label> <br />
                <input type="text" name="username" value="" class="form-control" required /> <br />
                <label for="item">Email: </label> <br />
                <input type="email" name="email" value="" class="form-control" required /> <br />
                <label for="item">Password: </label><br />
                <input type="password" name="password" value="" class="form-control" required /> <br />
                <input type="submit" value="Register" class="form-control" /> <br>
            </form>
        </div>
    </div>
</div>
@endsection
