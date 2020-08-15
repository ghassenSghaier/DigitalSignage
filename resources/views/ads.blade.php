@extends('layouts.app')

@section('content')
<div class="container content">
<div class="row">
    <div class="col-md-6">
        <h1>Publicités</h1>
    </div>
    <div class="col-md-6 text-right">
    <br>
        <a href="" class="btn btn-success" title="" data-toggle="modal" data-target="#myModal">Ajouter une publicité</a>
    </div>
</div>
<hr>
   <table class="table table-striped">
       <tr>
           <th>ID</th>
           <th>Titre</th>
           <th>Sociétés</th>
           <th>Date de diffusion</th>
           <th>Video</th>
           <th>Diffusion sur</th>
           <th>Date de création</th>
        
           <th>Actions</th>
       </tr>
       @foreach($ads as $ad)
            <tr>
                <td>{{$ad->id}}</td>
                <td>{{$ad->titre}}</td>
                <td>{{$ad->company->name}}</td>
                <td>{{$ad->begin}} - {{$ad->end}}</td>
                
                <td><a href="{{asset('video/').'/'.$ad->video}}">video</a> </td>
               <td>
                @foreach($ad->buses as $bus)
                Car {{$bus->reference}} -
                @endforeach
                </td>
                <td>{{$ad->created_at}}</td>

                <td>
                 {!! Form::open(['url' => route('delete-ad')]) !!}
                  <input type="hidden" name="id" value="{{$ad->id}}">
                <button class="btn btn-xs btn-danger">Supprimer</button>
                {!! Form::close() !!}
                </td>
            </tr>
       @endforeach
   </table>
</div>


<!--modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ajouter une publicité</h4>
      </div>
        {!! Form::open(['url' => route('add-ad'), 'id'=>'new-ad', 'files'=>true]) !!}
      <div class="modal-body">
            <div class="form-group">
                <label>Titre</label>
                {!! Form::text('titre', null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Video</label>
                {!! Form::file('video',  null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Pour la société</label>
                {!! Form::select('company_id', $companies , null, ['class'=>'form-control ', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Diffusion commencera</label>
                {!! Form::text('begin',  null, ['class'=>'form-control datetimepicker ', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Diffusion finira</label>
                {!! Form::text('end',  null, ['class'=>'form-control datetimepicker', 'required'=>true]) !!}
            </div>

            <button class="btn btn-info search-buses" type="submit">Chercher les Bus disponibles</button>
            <br>
            <div class="form-group buses" style="display: none">
                <label>Diffusée sur?</label>
                {!! Form::select('buses[]', $buses,  null, ['class'=>'form-control', 'multiple'=>true, 'required'=>true]) !!}
            </div>
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
         <button class="btn btn-success ads-submit" type="submit">Ajouter</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->
@endsection


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('js/datetimepicker/build/jquery.datetimepicker.min.css')}}">
@stop

@section('js')
<script type="text/javascript" src="{{asset('js/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
<script type="text/javascript">
  
    jQuery.datetimepicker.setLocale('en');
    jQuery('.datetimepicker').datetimepicker();

    $('.datetimepicker').on('change', function(){
        $('.buses, .ads-submit').hide();
    });



    $('.search-buses').on('click', function(e){
      e.preventDefault();

        var form = $('#new-ad');
        var data = form.serialize();



        $.ajax({
          type: "POST",
          data: data,
          dataType: 'json',
          url: "{{route('search-bus-disp')}}",
          success: function(result){
            console.log(result);
              $('.buses select').html('');
              for (v in result){
                $('.buses select').append('<option value="'+v+'">'+result[v]+'</option>');
              }
              $('.buses, .ads-submit').show();
              
          }
      });


    });
</script>

@stop