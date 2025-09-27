@extends('layouts.cbt-peserta')

@section('title', 'Pengerjaan Soal')

@section('content')
    <livewire:participant-competition 
        :competition="$competition" 
        :questions="$questions" 
        :answers="$answers" 
        :question_number="$question_number"
        :participant="$participant" 
    />
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', () => ({
                time: dayjs("{{ $end }}"),
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
                    const now = dayjs();
                    const diff = this.time.diff(now)

                    if (diff <= 0) {
                        clearInterval(this.timer);
                        this.minutes = 0;
                        this.seconds = 0;
                        window.location.reload();
                        return
                    }

                    this.minutes = this.time.diff(now, 'minute')
                    this.seconds = this.time.diff(now, 'second') % 60
                }
            }))
        })

    </script>
@endpush
