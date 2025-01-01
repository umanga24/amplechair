@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif

<script>
    setTimeout(function(){
        $('.alert').slideUp('slow');
    }, 4000);
</script>