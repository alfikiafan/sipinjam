@if(session('success'))
<div id="successAlert" class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
    <p class="m-0">{{ session('success')}}</p>
</div>
@endif

@if($errors->any())
    <div id="errorAlert" class="position-fixed bg-danger rounded right-3 text-sm py-2 px-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    // Auto hide success alert after 3 seconds
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 3000);
    }

    // Auto hide error alert after 3 seconds
    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(function() {
            errorAlert.style.display = 'none';
        }, 3000);
    }
</script>