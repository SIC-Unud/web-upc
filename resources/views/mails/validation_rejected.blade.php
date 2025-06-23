<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran UPC 2025</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style="font-family: sans-serif; background-color: #212429; color: white; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem;">

    <div style="width: 100%; background-color: #212429; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 10px 15px rgba(0,0,0,0.3);">

        <!-- Header -->
        <div style="background-color: #212429; padding: 1.5rem;">
            <div style="margin-bottom: 1rem;">
                <img src="{{ asset('logo-with-name.png')}}" alt="UPC 2025" style="width: 80px; height: 50px;">{{-- ganti saat hosting url {{ asset('assets/hero-100persen.png') }} --}}
            </div>
            <h1 style="font-size: 1.25rem; font-weight: 600; color: #d1d5db;">Halo, [Calon Jawara UPC 2025]!</h1>
            <p style="font-size: 0.875rem; margin-top: 0.5rem; color: #d1d5db;">
                Mohon maaf, pendaftaran Anda untuk {{ $competition }} gagal divalidasi karena alasan berikut:
            </p>
        </div>

        <!-- Detail Box -->
        <div style="background-color: white; color: black; padding: 20px; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
            <p style="font-size: 0.875rem; margin-bottom: 12px; color: #000">Alasan gagal:</p>
            <p style="font-size: 0.875rem; margin-bottom: 12px; color: #000">"{{ $reject_message }}"</p>

            <p style="font-size: 0.875rem; margin-bottom: 0.5rem; color: #000">Namun jangan khawatir, anda masih bisa memperbaiki data dengan klik tombol di bawah ini:</p>
            <div style="text-align: center; margin: 20px 0;">
                <a href="/blablabla/{{ $no_registration }}"
                    style="display: inline-block; background-color: #d9d9d9; color: black; padding: 12px 24px; text-decoration: none; border-radius: 9999px; font-weight: 500; font-family: Arial, sans-serif;">
                    Perbaiki Formulir
                </a>
                {{-- ini linknya belum ada ketentuan nama --}}
            </div>

            <p style="font-size: 0.875rem; margin-bottom: 1rem; color: #000">Jika terdapat pertanyaan lainnya, dapat menghubungi kontak humas UPC 2025, di sini.</p>
            <p style="font-size: 0.875rem; color: #000">Salam hangat,<br>Panitia UPC 2025.</p>
        </div>

        {{-- footer --}}
        <div style="background-color: #212429; padding: 1rem;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" style="padding-bottom: 0.5rem;">
                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                            <tr>
                                <td style="padding: 0 0.5rem;">
                                    <a href="https://wa.me/yourwhatsapplink" target="_blank" style="display: block;">
                                        <img src="{{ asset('wa.png')}}" alt="YouTube" style="height: 24px;">
                                    </a>
                                </td>
                                <td style="padding: 0 0.5rem;">
                                    <a href="https://www.instagram.com/yourinstagramlink" target="_blank" style="display: block;">
                                        <img src="{{ asset('ig.png')}}" alt="YouTube" style="height: 24px;">
                                    </a>
                                </td>
                                <td style="padding: 0 0.5rem;">
                                    <a href="https://www.tiktok.com/@yourtiktoklink" target="_blank" style="display: block;">
                                        <img src="{{ asset('tiktok.png')}}" alt="TikTok" style="height: 24px; display: block;">
                                    </a>
                                </td>
                                <td style="padding: 0 0.5rem;">
                                    <a href="https://www.youtube.com/youryoutubelink" target="_blank" style="display: block;">
                                        <img src="{{ asset('youtube.png')}}" alt="YouTube" style="height: 24px;">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-top: 16px;">
                        <img src="{{ asset('logo-with-name.png')}}" alt="UPC 2025" style="width: 40px; opacity: 0.7; display: block;">
                    </td>
                </tr>
            </table>
        </div>
        <div style="background-color: #212429; text-align: center; padding: 6px;">
            <p style="font-size: 0.75rem; color: #9ca3af;">© 2025 UDAYANAPHYSICSCHAMPIONSHIP. All Rights Reserved</p>
        </div>
    </div>

</body>
</html>


