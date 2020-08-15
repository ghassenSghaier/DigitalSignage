@extends('layouts.app')

@section('content')
<div class="container content">
<div class="row">
    <div class="col-md-6">
        <h1>Bus</h1>
    </div>
    <div class="col-md-6 text-right">
    <br>
        <a href="" class="btn btn-success" title="" data-toggle="modal" data-target="#myModal">Ajouter un Bus</a>
    </div>
</div>
<hr>
   <table class="table table-striped">
       <tr>
           <th>ID</th>
           <th>Référence</th>
           <th>Arret Départ</th>
           <th>Arret Arrivé</th>
           <th>Date de création</th>
      
           <th>Actions</th>
       </tr>
       @foreach($buses as $bus)
            <tr>
                <td>{{$bus->id}}</td>
                <td>{{$bus->reference}}</td>
                <td>{{$bus->pickup}}</td>
                <td>{{$bus->drop}}</td>
                <td>{{$bus->created_at}}</td>
                <td><a href="#" data-id="{{$bus->id}}" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modif-{{$bus->id}}">Modifier</a></td>
            </tr>
       @endforeach
   </table>
</div>


@foreach($buses as $bus)
   
<!--modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modif-{{$bus->id}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifer un Bus</h4>
      </div>
        {!! Form::model($bus, ['url' => route('edit-bus'), 'files'=>true]) !!}
        <input type="hidden" name="id" value="{{$bus->id}}">
      <div class="modal-body">
            <div class="form-group">
                <label>Référence</label>
                {!! Form::text('reference', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Arrêt de départ</label>
                {!! Form::text('pickup', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Arrêt de d'arrivé</label>
                {!! Form::text('drop', null, ['class'=>'form-control']) !!}
            </div>
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-success" type="submit">Ajouter</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->


       @endforeach


<!--modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ajouter un Bus</h4>
      </div>
        {!! Form::open(['url' => route('add-bus'), 'files'=>true]) !!}
      <div class="modal-body">
            <div class="form-group">
                <label>Référence</label>
                {!! Form::text('reference', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Arrêt de départ</label>
                {!! Form::text('pickup', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Arrêt de d'arrivé</label>
                {!! Form::text('drop', null, ['class'=>'form-control']) !!}
            </div>
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-success" type="submit">Ajouter</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->
@endsection
