@extends('layouts.app')

@section('content')
@if(Auth::user()->company_id != null)
<div class="container content">
 <h1>Les publicités de votre société {{$company[0]->name}}</h1>

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
       @foreach($company[0]->ads as $ad)
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
<br>
@endif
<div class="container content">
  <h2>Les publicités en temps réel par Bus</h2>
  <div class="row">
  
  @foreach($buses as $bus)
      <div class="col-md-2">
        <h3 class="well text-center"><a href="{{route('bus-pub', $bus->id)}}" target="_blank">Bus n° {{$bus->reference}}</h3>

      </div>
  @endforeach
  </div>
</div>





@endsection
