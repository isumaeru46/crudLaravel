@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                {{ Form::hidden('nomeProduto', null, array('id' => 'nomeProduto_id')) }}
                {!! Form::text('search_text', null, array('placeholder' => 'Procurar...','class' => 'form-control','id'=>'search_text')) !!}
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">

                {!! Form::button('Adicionar',array('class' => 'btn','onclick'=>'adicionarProduto();')) !!}
            </div>
        </div>
    </div>

    <script>

        function adicionarProduto(){
            if(document.getElementById('nomeProduto_id').value != ""){
                alert(document.getElementById('nomeProduto_id').value);
                document.getElementById('nomeProduto_id').value = "";
                document.getElementById('search_text').value = "";
            }
        }

        $(document).ready(function() {
            src = "{{ route('searchajax') }}";
            $("#search_text").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            response(data);

                        }
                    });
                },
                select: function (event, ui){
                    if(ui.item){
                        document.getElementById('nomeProduto_id').value = ui.item.value;
                    }
                },
                minLength: 3,

            });
        });
    </script>
@endsection