@extends('layouts.main')

@section('title', 'Registration')

@section('content')
     {{-- content --}}
     <livewire:registration-form />
     {{-- scripts --}}
@endsection

@section('script')
     <script>
          window.addEventListener('download-invoice', (event) => {
               const no_registration = event.detail.no_registration;
               window.open(`/invoice/${no_registration}`, '_blank');
          });
     </script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
          window.addEventListener('validation-errors', event => {
               Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: 'Periksa kembali masukan anda',
                    confirmButtonColor: '#d33',
               });
          });
     </script>
@endsection