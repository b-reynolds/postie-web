<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/prism.css' )}}"/>
    <script src="{{ asset('js/prism.js') }}"></script>
    <style>
        body {
          background-color: #2d2d2d;
        }
        .nav {
            background-color: #171717;
        }
        .subnav {
            background-color: #272727; 
        }
        .col {
            padding-left: 8px;
            padding-right: 8px
        }
        .but {
            margin: 6px
        }
        code {
          color: #cccccc;
        }
        span {
          color:white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        {{-- <div class="row nav">
          <div class="col-sm-12 align-self-center text-left">
          <img src="{{ asset('images/logo-no-bg.png') }}" style="max-width: 48px"/>
          </div>
        </div> --}}
        <div class="row justify-content-end subnav">
          <div class="col-sm align-self-center text-md-left col">
          <img src="{{ asset('images/logo.png') }}" style="max-width: 48px"/>
          </div>
          <div class="col-sm align-self-center text-md-center col">
            <code>{{ $file->name }} <span class="badge badge-dark">{{ $fileType->name }}</span></code>
          </div>
          <div class="col-sm text-right col">
            <a href="{{ URL::to('raw/' . $id) }}" role="button" class="btn btn-dark btn-sm but">Raw</a>
            <button type="button" class="btn btn-dark btn-sm but">Download</button>
          </div>
      </div>
      <div class="row justify-content-end flex-grow-1 subnav">
        <div class="col-sm align-self-center text-md-left col" style="padding: 0px">
          <pre class="line-numbers" style="margin: 0px"><code class="language-{{ $fileType->name }}">{{ $file->contents }}</code></pre>
        </div>
    </div>
</body>

</html>