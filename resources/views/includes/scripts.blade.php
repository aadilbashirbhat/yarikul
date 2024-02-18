<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
<script>
    @if(session('success'))
    new Noty({
        text: '{{ session("success") }}',
        type: 'success',
        timeout: 3000,
        layout: 'topRight' 
    }).show();
    @endif

    @if(session('error'))
    new Noty({
        text: '{{ session("error") }}',
        type: 'error',
        timeout: 3000,
        layout: 'topRight' 
    }).show();
    @endif
</script>