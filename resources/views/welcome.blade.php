<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

        <link rel="stylesheet" href="{{asset('css/app.css')}}">


    </head>
    <body class="bg-dark col-md-12">

            <form action=" {{route('image.store')}} " class="dropzone" id="my-awesome-dropzone" method="POST">
                <a href="{{route('image.index')}}" class="btn btn-primary btn-lg btn-block">Ver galeria</a>
            </form>

            

        
        <script src="{{asset('js/app.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
        
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers:{
                    'X-CSRF-TOKEN' : "{{csrf_token()}}",
                },
                acceptedFiles:'image/*,',
                dictDefaultMessage: "Arrastra acá para cargar imagenes",
                maxFilessize: 2,
                maxFiles: 4,
            };
        </script>
    </body>
</html>
