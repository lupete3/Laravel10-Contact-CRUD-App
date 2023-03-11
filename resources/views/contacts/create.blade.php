@extends('contacts.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter nouveau contact</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Retour</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Attention!</strong> Vous avez des problèmes liés à vos informations .<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('contacts.store') }}" method="POST" id="image-upload" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                <input type="text" name="nom" class="form-control" placeholder="Nom">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone:</strong>
                <input type="text" name="telephone" class="form-control" placeholder="Téléphone">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Image:</strong>
            <input 
                type="file" 
                name="image" 
                id="inputImage"
                class="form-control">
            <span class="text-danger" id="image-input-error"></span>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </div>
   
</form>

<img id="preview-image" width="200px">

<script type="text/javascript">
      
    /*------------------------------------------
    --------------------------------------------
    File Input Change Event
    --------------------------------------------
    --------------------------------------------*/
    $('#inputImage').change(function(){    
        let reader = new FileReader();
     
        reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
        }   
      
        reader.readAsDataURL(this.files[0]); 
       
    });

    /*------------------------------------------
    --------------------------------------------
    Form Submit Event
    --------------------------------------------
    --------------------------------------------*/
    $('#image-upload').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error').text('');
    
           $.ajax({
                type:'POST',
                url: "{{ route('contacts.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(response){
                    $('#image-upload').find(".print-error-msg").find("ul").html('');
                    $('#image-upload').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#image-upload').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });
    });
        
</script>
        
@endsection