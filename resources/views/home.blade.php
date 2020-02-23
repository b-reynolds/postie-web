<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Postie</title>
    <style>
        body {
          background-color: #2d2d2d;
          color: white;
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
        textarea {
            font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New, monospace;
        }
        .field-dark {
            background-color: #272727;
            color: #cccccc
        }
        .form-control:focus { 
            background-color: #2b2b2b;
            color: #cccccc
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-end subnav">
          <div class="col-sm align-self-center text-md-left col">
          <img src="{{ asset('images/logo.png') }}" style="max-width: 48px"/>
          </div>
          <div class="col-sm align-self-center text-md-center col">
            <code>Postie</code>
          </div>
          <div class="col-sm text-right col">
          </div>
      </div>
    </div>

    <form method="post" style="margin: 16px">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control field-dark" name="name" required>
        </div>

        <div class="form-group">
            <label for="fileType">Type</label>
            <select class="custom-select field-dark" name="fileType" required>
            @foreach ($fileTypes as $fileType)
                <option value="{{ $fileType->id }}">{{ $fileType->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="expiryDate">Expires</label>
            <select class="custom-select field-dark" name="expires" required>
            @foreach ($expiryOptions as $id => $duration)
                <option value="{{ $id }}">{{ $duration->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="contents">Contents</label>
            <textarea class="form-control field-dark" rows="10" name="contents" required></textarea>
        </div>

        <button type="submit" class="btn btn-dark" style="width: 100%">Create</button>
    </form>
</body>

</html>