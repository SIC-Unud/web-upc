@extends('layouts.cbt-peserta')

@section('title', 'Soal')

@section('content')
    <livewire:participant-competition :competition="$competition" :questions="$questions" :answers="$answers" :question_number="$question_number"
        :participant="$participant" />
@endsection

@section('modal')
    {{-- Modal Pas Masuk --}}
    {{-- <x-cbtModal></x-cbtModal> --}}
    {{-- Modal Pas Masuk --}}

    {{-- Modal Kalo User mau Keluar dari Tes --}}
    {{-- <x-cbtAlert></x-cbtAlert> --}}
    {{-- Modal Kalo User mau Keluar dari Tes --}}

    {{-- Modal kalo User dah kelar buat Tes --}}
    {{-- <x-cbt-finish-modal></x-cbt-finish-modal> --}}
    {{-- Modal kalo User dah kelar buat Tes --}}
@endsection


@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script> --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', () => ({
                time: dayjs.utc("{{ $end }}"),
                minutes: 0,
                seconds: 0,
                confirmFinish: false,
                init() {
                    this.updateCountdown()
                    setInterval(() => {
                        this.updateCountdown()
                    }, 1000);
                },
                updateCountdown() {
                    const now = dayjs().utc()
                    const diff = this.time.diff(now)

                    if (diff <= 0) {
                        this.minutes = 0
                        this.seconds = 0
                        console.log('waktu habis')
                        return
                    }

                    this.minutes = this.time.diff(now, 'minute')
                    this.seconds = this.time.diff(now, 'second') % 60
                }
            }))
        })

        document.addEventListener("visibilitychange", (event) => {
            if (document.visibilityState != "visible") {
                console.log("pindah tab");
            }
        });
    </script>
@endpush
