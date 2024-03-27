<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
</head>

<body class="hold-transition  login-page">
    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="login-box">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Login</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->has('loginError'))
                    <div class="alert alert-danger">
                        {{ $errors->first('loginError') }}
                    </div>
                    @endif
                    <div class="form-group row">
                        {{-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> --}}
                        <div class="col-sm-12 form-group">
                            {{-- <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> --}}
                            <x-form.label id="email">Email</x-form.label>
                            <x-form.input type="text" name="email" class="form-control-lg" placeholder="Enter Your Email Or Username Or phone" />                         </div>
                    </div>
                    <div class="form-group row">
                        {{-- <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label> --}}
                        <div class="col-sm-12 form-group">
                            <x-form.label id="password">Password</x-form.label>
                            <x-form.input type="password" name="password" class="form-control-lg" placeholder="Password" /> 
                            {{-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check form-group">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label" for="exampleCheck2">Remember me</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Sign in</button>
                    {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
    <!-- /.card -->
    <!-- jQuery -->
    {{-- <script src="../../plugins/jquery/jquery.min.js"></script> --}}
    <!-- Bootstrap 4 -->
    {{-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <!-- bs-custom-file-input -->
    {{-- <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> --}}
    <!-- AdminLTE App -->
    {{-- <script src="../../dist/js/adminlte.min.js"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="../../dist/js/demo.js"></script> --}}
    <!-- Page specific script -->
    {{-- <script>
$(function () {
  bsCustomFileInput.init();
});
</script> --}}
</body>

</html>
