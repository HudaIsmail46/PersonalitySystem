<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UMSFRI') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/be4357277b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')
        <div class="content-wrapper">
            <script>
                $(function() {
                    let copyButtonTrans = 'Copy'
                    let csvButtonTrans = 'CSV'
                    let excelButtonTrans = 'Excel'
                    let pdfButtonTrans = 'PDF'
                    let printButtonTrans = 'Print'
                    let colvisButtonTrans = 'Columns'

                    let languages = {
                        'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
                        'id': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
                    };

                    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                        className: 'btn'
                    })
                    $.extend(true, $.fn.dataTable.defaults, {
                        language: {
                            url: languages['en']
                        },
                        columnDefs: [{
                            orderable: false,
                            className: 'select-checkbox',
                            targets: 0
                        }, {
                            orderable: false,
                            searchable: false,
                            targets: -1
                        }],
                        select: {
                            style: 'multi+shift',
                            selector: 'td:first-child'
                        },
                        order: [],
                        scrollX: true,
                        pageLength: 100,
                        dom: 'lBfrtip<"actions">',
                        buttons: [{
                                extend: 'copy',
                                className: 'btn-default',
                                text: copyButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn-default',
                                text: csvButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'excel',
                                className: 'btn-default',
                                text: excelButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn-default',
                                text: pdfButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                className: 'btn-default',
                                text: printButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'colvis',
                                className: 'btn-default',
                                text: colvisButtonTrans,
                                exportOptions: {
                                    columns: ':visible'
                                }
                            }
                        ]
                    });

                    $.fn.dataTable.ext.classes.sPageButton = '';
                });

            </script>
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>
</body>

</html>