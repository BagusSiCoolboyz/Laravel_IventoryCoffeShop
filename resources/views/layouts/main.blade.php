<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/image/kopte.png">
    <title>KOPTE | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    {{-- Data Table --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.css" rel="stylesheet"
        crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    {{-- NAVBAR --}}
    @include('layouts.navbar')
    {{-- END NAVBAR --}}

    <div class="container-lg ms-4 me-4">
        <div class="row">
            {{-- SIDEBAR --}}
            @include('layouts.sidebar')
            {{-- END SIDEBAR --}}

            {{-- CONTENT --}}
            <div class="col-lg-9">
                @yield('contents')
            </div>
            {{-- END CONTENT --}}

        </div>

        {{-- COPYRIGHT --}}
        @include('layouts.footer')
        {{-- END COPYRIGHT --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                html: '{{ $message }}',
                showConfirmButton: false,
                timer: 3000,
            })
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: '{{ $message }}',
                timer: 6000,
            })
        </script>
    @endif

    <script>
        $(document).ready(() => {
            new DataTable('#myTable');
        })

        function swalert(status, pesan, redirectUrl) {
            if (status == "success") {
                Swal.fire({
                    icon: "success",
                    title: status,
                    text: pesan,
                    showConfirmButton: true,
                    timer: 4000,
                }).then((result) => {
                    if (typeof redirectUrl !== "undefined" && redirectUrl !== "") {
                        if (
                            result.isConfirmed ||
                            result.dismiss === Swal.DismissReason.timer
                        ) {
                            window.location.href = redirectUrl;
                        }
                    }
                });
            } else if (status == "warning") {
                Swal.fire({
                    icon: "warning",
                    title: status,
                    text: pesan,
                    showConfirmButton: true,
                    timer: 5000,
                });
            } else if (status == "error") {
                Swal.fire({
                    icon: "error",
                    title: status,
                    text: pesan,
                    timer: 7000,
                });
            }
        }
    </script>

</body>

</html>
