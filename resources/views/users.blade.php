@extends('layouts.app')

@section('content')
<div class="container content">
<div class="row">
    <div class="col-md-6">
        <h1>Clients</h1>
    </div>
    <div class="col-md-6 text-right">
    <br>
        <a href="" class="btn btn-success" title="" data-toggle="modal" data-target="#myModal">Ajouter un client</a>
    </div>
</div>
<hr>
   <table class="table table-striped">
       <tr>
           <th>ID</th>
           <th>Nom et prénom</th>
           <th>Email</th>
           <th>Sociétés</th>
           
           
           <th>Date de création</th>
        
           <th>Actions</th>
       </tr>
       @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->company->name}}</td>
                <td>{{$user->created_at}}</td>
                <td><a class="btn btn-info" data-toggle="modal" data-target="#edit-{{$user->id}}">Editer</a></td>
                
            </tr>
       @endforeach
   </table>
</div>


<!--modal-->
<div class="modal fusere" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ajouter un Client</h4>
      </div>
        {!! Form::open(['url' => route('add-user')]) !!}
      <div class="modal-body">
            <div class="form-group">
                <label>Nom et prénom</label>
                {!! Form::text('name', null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Email</label>
                {!! Form::email('email', null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>


            <div class="form-group">
                <label>Mot de passe</label>
                {!! Form::password('password', ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Société</label>
                {!! Form::select('company_id', $companies, null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
         <button class="btn btn-success users-submit" type="submit">Ajouter</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->

  @foreach($users as $user)

<!--modal-->
<div class="modal fusere" tabindex="-1" role="dialog" id="edit-{{$user->id}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ajouter un Client</h4>
      </div>
        {!! Form::model($user, ['url' => route('edit-user', $user->id)]) !!}
      <div class="modal-body">
            <div class="form-group">
                <label>Nom et prénom</label>
                {!! Form::text('name', null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Email</label>
                {!! Form::email('email', null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>


            <div class="form-group">
                <label>Mot de passe</label>
                {!! Form::password('password', ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            <div class="form-group">
                <label>Société</label>
                {!! Form::select('company_id', $companies, null, ['class'=>'form-control', 'required'=>true]) !!}
            </div>

            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
         <button class="btn btn-success users-submit" type="submit">Ajouter</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->
 @endforeach
@endsection
