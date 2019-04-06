<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script type="text/javascript"  src="{{asset('js/app.js')}}"></script>

    <title>Phone numbers</title>
</head>
<body>

    <div class="container-fluid">

        <h1>Phone numbers</h1>

        <div class="alert alert-danger" role="alert" style="display: none;">
            <span class="text"></span>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-3 col-lg-2">
                <select id="select-country" class="filterable" parameter="countryId">
                    <option value="">Select Country</option>
                @foreach($countryPhones as $countryPhone)
                    <option value="{{ $countryPhone->id }}">{{ $countryPhone->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2">
                <select id="select-state" class="filterable" parameter="validPhone">
                    <option value="">Select All Phone Numbers</option>
                @foreach($phoneStates as $phoneState)
                    <option value="{{ $phoneState->id }}">{{ $phoneState->long_description }}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-6">
                <div id="div-grid">

                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">

    const url = "{{ url('grid') }}";

    function refreshGrid(url){
        $.ajax({
            method: "POST",
            url: url,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function( response ) {
            $('#div-grid').html(response);
            $('#div-grid').find('.page-link').click(function(e){
                e.preventDefault();
                refreshGrid( $(this).attr('href') );
            })
        }).fail(function( xhr ){

            let alertMessage = "<ul>";
            $.each(xhr.responseJSON.errors, function(key, value){
                alertMessage +="<li>"+value[0]+"</li>";
            })
            alertMessage += "</ul>";

            $('.alert .text').html(alertMessage);

            $('.alert').css('display', 'block');
            $(".alert").delay(2000).slideUp(200, function() {
                $('.alert').css('display', 'none');
            });
        });
    }

    function setGridFilter(){
        let filterUrl = '?';
        $('.filterable').each(function(index, item){
            let filterValue = $(item).val();
            if(filterValue !== ''){
                filterUrl += '&'+$(item).attr('parameter')+'='+filterValue;
            }
        });
        refreshGrid(url+filterUrl);
    }

    $(function(){
        $('.filterable').change(setGridFilter);

        refreshGrid(url);
    })

</script>
</html>