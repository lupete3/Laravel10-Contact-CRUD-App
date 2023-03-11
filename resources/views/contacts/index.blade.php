@extends('contacts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Exemple Laravel 10 pour débutants - Pdevtuto.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contacts.create') }}"> Ajouter un nouveau contact</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered table-sm">
        <tr>
            <th>No</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $contact->nom }}</td>
            <td>{{ $contact->telephone }}</td>
            <td><img src="{{asset('images/'.$contact->image)}}" width = 100 alt=""></td>
            <td>
                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
   
                    <a class="btn btn-info btn-sm" href="{{ route('contacts.show',$contact->id) }}">Afficher</a>
    
                    <a class="btn btn-primary btn-sm" href="{{ route('contacts.edit',$contact->id) }}">Modifier</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $contacts->links() !!}
      
@endsection