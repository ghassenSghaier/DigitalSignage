@extends('layouts.app')

@section('content')
<div class="container content">
<div class="row">
    <div class="col-md-6">
        <h1>Sociétés</h1>
    </div>
    <div class="col-md-6 text-right">
    <br>
        <a href="" class="btn btn-success" title="" data-toggle="modal" data-target="#myModal">Ajouter une société</a>
    </div>
</div>
<hr>
   <table class="table table-striped">
       <tr>
           <th>ID</th>
           <th>Logo</th>
           <th>Nom</th>
           <th>Description</th>
           <th>Date de création</th>
        

           <th>Actions</th>
       </tr>
       @foreach($companies as $company)
            <tr>
                <td>{{$company->id}}</td>
                <td><img src="{{asset('img/uploads')}}/{{$company->logo}}" style="height: 50px;"></td>
                <td>{{$company->name}}</td>
                <td>{{$company->description}}</td>
                <td>{{$company->created_at}}</td>
                <td><a href="#" data-id="{{$company->id}}" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modif-{{$company->id}}">Modifier</a></td>
            </tr>
       @endforeach
   </table>
</div>


@foreach($companies as $company)
   
<!--modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modif-{{$company->id}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifer une société</h4>
      </div>
        {!! Form::model($company, ['url' => route('edit-company'), 'files'=>true]) !!}
        <input type="hidden" name="id" value="{{$company->id}}">
      <div class="modal-body">
      <p class="center-text"><img src="{{asset('img/uploads')}}/{{$company->logo}}"></p>
            <div class="form-group">
                <label>Nom de la société</label>
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Description de la société</label>
                {!! Form::text('description', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Description de la société</label>
                {!! Form::file('logo', null, ['class'=>'form-control']) !!}
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
        <h4 class="modal-title">Ajouter une société</h4>
      </div>
        {!! Form::open(['url' => route('add-company'), 'files'=>true]) !!}
      <div class="modal-body">
            <div class="form-group">
                <label>Nom de la société</label>
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Description de la société</label>
                {!! Form::text('description', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Description de la société</label>
                {!! Form::file('logo', null, ['class'=>'form-control']) !!}
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
