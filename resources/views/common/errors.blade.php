@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="container">
     
            <br><br>
            
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            
        
    </div>
    
@endif