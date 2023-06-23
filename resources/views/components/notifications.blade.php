@if(session('success'))
<div id="successAlert" class="position-fixed bg-success rounded right-3 text-sm py-2 px-4 ms-3" style="z-index: 9;">
    <p class="m-0 text-white">{{ session('success')}}</p>
</div>
@endif

@if(session('error'))
    <div id="errorAlert" class="position-fixed bg-danger rounded right-3 text-sm py-2 px-4 ms-3" style="z-index: 9;">
        <ul class="m-0 p-0 text-white">
            @foreach (explode('|', session('error')) as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 3000);
    }

    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(function() {
            errorAlert.style.display = 'none';
        }, 3000);
    }
</script>