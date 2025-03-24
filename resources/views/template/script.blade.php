<!-- Bootstrap core JavaScript-->
<script src="{{ asset('tamplate/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('tamplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('tamplate/js/sb-admin-2.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        // Tampilkan SweetAlert2
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        // Sembunyikan pesan sukses biasa
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        });
    @endif
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap semua tombol hapus
        const deleteButtons = document.querySelectorAll('.delete-button');

        // Loop melalui setiap tombol hapus
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const formId = this.getAttribute('data-id'); // Ambil ID form
                const form = document.getElementById(`delete-form-${formId}`); // Ambil form

                // Tampilkan SweetAlert2
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, submit form
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- Script untuk SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert untuk pesan sukses
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
        });
    @endif

    // SweetAlert untuk konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });
    });
</script>
