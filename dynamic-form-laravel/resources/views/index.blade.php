<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dynamic Form in Laravel</title>

    <!-- Include Bootstrap CSS -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Include Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container d-flex justify-content-center h-100">
        <div class="my-auto">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title"><img src="/favicon.ico" alt="Laravel" class="d-inline-block icon"> Dynamic
                        Form Fields in Laravel </h4>
                    <form method="POST" action="/add">
                        @csrf
                        <input type="hidden" value="0" name="TotalForms">

                        <div class="form-group">
                            <div class="row" id="row_1">
                                <div class="col-10 ">
                                    <input class="form-control" placeholder="Field 1" type="text" name="field[]" id="field_1">
                                </div>
                                <div class="col-2">
                                    <a type="button" class="btn btn-danger" id="delItem"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>

                        <div id="begin">

                        </div>
                </div>
                <div class="card-footer ">
                    <a type="button" class="btn btn-success" id="addItem"><i class="fas fa-plus"></i></a>
                    <button type="submit" class="btn btn-primary float-end">Submit</i></button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include bootstrapJS -->
    <script src="/js/app.js"></script>
    <!-- Include JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Sweet2Alert -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

    <!--
    ** Retrieve session content from controller
    -->
    @if (session()->has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
            });

            Toast.fire({
                type: 'success',
                title: '{{ session()->get('success') }}'
            });
            
        </script>

    @elseif (session()->has('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
            });

            Toast.fire({
                type: 'success',
                title: '{{ session()->get('error') }}'
            });
           
        </script>

    @endif

    @section('js')
        <script>
            //delItem Function, called by a click in an ID.
            $(document).on("click", "#delItem", function() {
                $(this).closest('.form-group').remove();
            });
            // call addItem function
            $('#addItem').click(function() {
                $.addItem();
            });

            let count = 1;
            //addNewProduct Function
            $.addItem = function() {
                count++;

                var tmplMarkup = $("#item-order").html();
                var compiledTmpl = tmplMarkup.replace(/_prefix_/g, count);
                $("#begin").append(compiledTmpl);
                $('#TotalForms').val(count);
                $('.col-10').focus();
            }
        </script>
        <!--
        ** Form Template | the ID order is defined by [_prefix__] so you must not remove it.
        -->
        <script type="text" id="item-order">
            <div class="form-group">
                <div class="row mt-3" id="row__prefix_">
                    <div class="col-10 ">
                        <input class="form-control" placeholder="Field _prefix_" name="field[] type="text" id="field__prefix_">
                    </div>
                    <div class="col-2">
                        <a type="button" class="btn btn-danger" id="delItem"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>       
                </div>
        </script>
    </body>

    </html>
