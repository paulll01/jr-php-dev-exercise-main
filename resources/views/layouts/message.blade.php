
@if(session()->has('message'))
    <div class="w-full mx-auto p-3 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert" id="message">
        <p>{{ session()->get('message') }}</p>
    </div>
@endif
<script>
    if(document.getElementById('message')){
    setTimeout(function() {
        var alert = document.getElementById('message');
            alert.classList.add(['hidden']);
    }, 3000);
}
</script>

