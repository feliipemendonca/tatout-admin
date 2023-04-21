<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if(session('success'))
        Swal.fire(
            'Sucesso',
            '{!! session('success') !!}',
            'success'
        )
    @endif
    @if(session('status'))
        Swal.fire(
            'Sucesso',
            '{!! session('status') !!}',
            'success'
        )
    @endif
    @if(session('error'))
        Swal.fire(
            'Erro!',
            '{!! session('error') !!}',
            'error',
        )
    @endif
    @if(session('warning'))
        Swal.fire(
            'Atenção!',
            '{!! session('warning') !!}',
            'warning',
        )
    @endif
</script>