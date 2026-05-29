<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Instalasi - {{ $beritaAcara->nama }}</title>
    <style>
        @page {
            margin: 15px 15px 60px 15px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 0 25px 60px 35px;
            position: relative;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .header {
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        .header-content {
            display: table;
            width: 100%;
            gap: 70px
        }
        .header-logo {
            display: table-cell;
            width: 120px;
            flex: 0 0 120px;
            vertical-align: middle;
            text-align: center;
            padding-left: 10px;
            padding-right: 20px;
        }
        .header-logo img {
            max-width: 100px;
            max-height: 100px;
            width: auto;
            height: auto;
        }
        .logo-placeholder {
            font-size: 10pt;
            font-weight: bold;
            border: 1px solid #000;
            padding: 8px;
            width: 120%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 30px;
        }
        .header-text {
            flex: 1;
            text-align: center;
            padding: 0 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header-text h1 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            color: #000;
        }
        .header-text h2 {
            margin: 3px 0;
            font-size: 10pt;
            font-weight: bold;
        }
        .header-text p {
            margin: 2px 0;
            font-size: 8pt;
        }
        .main-content {
            margin-left: 35px;
            margin-right: 25px;
            margin-top: 15px;
            padding-bottom: 20px;
        }
        .section-title {
            background-color: #f0f0f0;
            padding: 5px;
            margin: 8px 0 5px 0;
            font-weight: bold;
            border-left: 3px solid #000;
            font-size: 9pt;
        }
        .data-table {
            width: 100%;
            margin-bottom: 8px;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 3px;
            vertical-align: top;
            font-size: 9pt;
        }
        .data-table td:first-child {
            width: 35%;
            font-weight: bold;
        }
        .data-table td:nth-child(2) {
            width: 3%;
        }
        .signature-section {
            margin-top: 30px;
            text-align: center;
        }
        .terms-section {
            margin-top: 10px;
            page-break-before: always;
            padding-bottom: 60px;
        }
        .terms-title {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 8px;
            text-decoration: underline;
        }
        .terms-content {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.4;
        }
        .terms-content h3 {
            font-size: 9pt;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .terms-content ol {
            margin-left: 15px;
            padding-left: 5px;
        }
        .terms-content ol li {
            margin-bottom: 5px;
        }
        .terms-content ul {
            margin-left: 15px;
            padding-left: 5px;
        }
        .terms-content ul li {
            margin-bottom: 3px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7pt;
            padding: 10px 15px;
            border-top: 1px solid #ccc;
            background-color: white;
        }
        .footer p {
            margin: 2px 0;
        }
        .photo-section {
            margin-top: 10px;
            page-break-before: always;
            padding-bottom: 60px;
        }
        .photo-title {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 10px;
        }
        .photo-grid {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .photo-row {
            display: table-row;
        }
        .photo-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }
        .photo-item img {
            width: 220px;
            height: 165px;
            border: 1px solid #ddd;
            padding: 3px;
        }
        .photo-item p {
            margin-top: 3px;
            font-weight: bold;
            font-size: 8pt;
        }
        .content-section {
            margin-bottom: 8px;
        }
        .no-photo {
            border: 1px dashed #ccc;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 8pt;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
        }
        .signature-img {
            max-width: 180px;
            max-height: 75px;
            object-fit: contain;
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 2px;
        }
        .signature-box {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 8px 0;
        }
        .signature-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            min-height: 160px;
        }
        .signature-label {
            margin: 0 0 5px 0;
            font-weight: bold;
        }
        .signature-name {
            margin: 8px 0 0 0;
            font-weight: bold;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <!-- Page 1: Header & Data Pelanggan -->
    <div class="header">
        <div class="header-content">
            <div class="header-logo">
                @if (file_exists(public_path('storage/images/mgdt.png')))
                    <img src="{{ public_path('storage/images/mgdt.png') }}" alt="Logo Megadata">
                @else
                    <div class="logo-placeholder">LOGO<br>MEGADATA</div>
                @endif
            </div>

            <div class="header-text">
                <h1>BERITA ACARA INSTALASI</h1>
                <h2>PT. MEGA ARTHA LINTAS DATA (MEGADATA.ISP)</h2>
                <p><strong>Kantor Pemasaran Besuki</strong></p>
                <p>Kp. Bringin Ds. Langkap Kec. Besuki Kab. Situbondo</p>
                <p>Email: megadatabesuki@gmail.com | Hp: +62 851-8682-3005</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <p style="margin-bottom: 8px;"><strong>Saya Yang Bertanda Tangan dibawah Ini :</strong></p>

        <table class="data-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ strtoupper($beritaAcara->nama) }}</td>
            </tr>
            <tr>
                <td>No. KTP</td>
                <td>:</td>
                <td>{{ $beritaAcara->no_ktp }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $beritaAcara->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <td>{{ strtoupper($beritaAcara->alamat) }}</td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td>:</td>
                <td>{{ $beritaAcara->no_hp }}</td>
            </tr>
            <tr>
                <td>Tanggal Registrasi</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($beritaAcara->tanggal_registrasi)->format('d-M-Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <div class="section-title">Telah Menerima Perangkat Pinjaman Dari Megadata Berupa :</div>

        <table class="data-table">
            <tr>
                <td>Jenis Perangkat</td>
                <td>:</td>
                <td>{{ $beritaAcara->jenis_perangkat }}</td>
            </tr>
            <tr>
                <td>MAC Address</td>
                <td>:</td>
                <td>{{ $beritaAcara->mac_address ?? '-' }}</td>
            </tr>
            <tr>
                <td>Serial Number</td>
                <td>:</td>
                <td>{{ $beritaAcara->serial_number ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <div class="section-title">LAPORAN TEKNISI</div>

        <table class="data-table">
            <tr>
                <td>Teknisi 1</td>
                <td>:</td>
                <td>{{ strtoupper($beritaAcara->nama_teknisi_1) }}</td>
            </tr>
            @if ($beritaAcara->nama_teknisi_2)
                <tr>
                    <td>Teknisi 2</td>
                    <td>:</td>
                    <td>{{ strtoupper($beritaAcara->nama_teknisi_2) }}</td>
                </tr>
            @endif
            <tr>
                <td>Paket Berlangganan</td>
                <td>:</td>
                <td>{{ $beritaAcara->paket_berlangganan }}</td>
            </tr>
            <tr>
                <td>Biaya Registrasi</td>
                <td>:</td>
                <td>Rp. {{ number_format(round($beritaAcara->biaya_registrasi), 0, ',', '.') }},-</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p><strong>PT. MEGA ARTHA LINTAS DATA</strong></p>
        <p>Kp. Bringin Ds. Langkap RT 01 RW 02 Kec. Besuki Kab. Situbondo Jawa Timur (68356)</p>
        <p>(085186823005) | helpdesk@megadata.net.id | megadata.net.id</p>
        <p>IG : @megadata.isp_besuki | TikTok : @megadata.isp_besuki</p>
    </div>

    <!-- Page 2: Syarat dan Ketentuan -->
    <div class="terms-section">
        <div class="terms-title">SYARAT DAN KETENTUAN BERLANGGANAN</div>
        <div class="terms-content">
            <p>Syarat dan Ketentuan Berlangganan ini adalah perjanjian antara PT. Mega Artha Lintas Data (MEGADATA-ISP)
                dan Pelanggan, selanjutnya disebut sebagai Perjanjian. Perjanjian ini berlaku efektif sejak pelanggan
                menyetujui untuk berlangganan layanan yang diselenggarakan PT. Mega Artha Lintas Data (MEGADATA-ISP)
                dengan dilakukannya pembayaran pertama kali kepada PT. Mega Artha Lintas Data (MEGADATA-ISP) atau pada
                saat Pelanggan mendapatkan layanan untuk pertama kali.</p>

            <h3>PASAL 1 – DEFINISI</h3>
            <p>PT. Mega Artha Lintas Data (MEGADATA-ISP) adalah perusahaan yang bergerak di bidang penyelenggaraan jasa
                dan jasa telekomunikasi.</p>
            <p>Pelanggan adalah perorangan atau badan usaha sebagai pengguna layanan yang diselenggarakan MEGADATA-ISP
                yang terikat ketentuan-ketentuan dalam Perjanjian ini.</p>
            <p>Aktivasi adalah proses instalasi/ pemasangan perangkat dan jaringan yang dibutuhkan di lokasi milik
                Pelanggan yang telah melakukan pendaftaran dan memenuhi syarat sebelum menikmati layanan yang
                diselenggarakan oleh MEGADATA-ISP.</p>
            <p>De-Aktivasi adalah proses penghentian layanan dan pengembalian perangkat dan jaringan yang terpasang di
                lokasi milik Pelanggan sehubungan dengan berakhirnya langganan.</p>
            <p>Lokasi adalah tempat milik Pelanggan di mana di lakukan Aktivasi.</p>

            <h3>PASAL 2 – LINGKUP PERJANJIAN</h3>
            <p>Perjanjian ini merupakan suatu ikatan antara PT. Mega Artha Lintas Data (MEGADATA-ISP) sebagai penyedia
                layanan, dengan Pelanggan sebagai pengguna layanan berdasarkan jenis dan fitur layanan yang dipilih
                Pelanggan.</p>

            <h3>PASAL 3 – JANGKA WAKTU DAN SYARAT-SYARAT BERLANGGANAN</h3>
            <ol>
                <li>Jangka waktu berlangganan dihitung sejak tanggal Aktivasi berdasarkan kategori waktu kontrak yang
                    dipilih Pelanggan.</li>
                <li>Putusnya Perjanjian tidak mengurangi hak dan kewajiban Para Pihak.</li>
                <li>Pelanggan mengambil kebenaran atas seluruh informasi yang diberikan dalam proses pendaftaran,
                    memberikan izin Aktivasi, dan menjamin keamanan perangkat selama jangka waktu berlangganan serta
                    mengembalikan perangkat dalam kondisi normal setelah selesai berlangganan.</li>
                <li>Pelanggan memberikan deposit uang jaminan sebesar Rp. 200.000,- (Dua Ratus Ribu Rupiah) jika alamat
                    kartu identitas tidak sesuai dengan alamat Lokasi Aktivasi dan tidak dapat menunjukkan Surat
                    Keterangan Domisili yang valid.</li>
                <li>Perjanjian ini berlaku sejak tanggal Aktivasi sampai dengan tanggal De-Aktivasi.</li>
            </ol>

            <h3>PASAL 4 – BIAYA BERLANGGANAN DAN PEMBAYARAN</h3>
            <ol>
                <li>MEGADATA-ISP menetapkan biaya-biaya yang harus dibayarkan Pelanggan adalah sebagai berikut:
                    <ol type="a">
                        <li>Biaya registrasi dan Aktivasi;</li>
                        <li>Biaya langganan;</li>
                        <li>Biaya lain-lain yang timbul akibat adanya Perjanjian ini.</li>
                    </ol>
                </li>
                <li>Tata cara pembayaran:
                    <ol type="a">
                        <li>Biaya registrasi dan Aktivasi, biaya langganan bulan pertama, dan biaya deposit (jika
                            berlaku) dibayarkan setelah proses pendaftaran langganan;</li>
                        <li>Biaya langganan dibayarkan maksimal H+7 setelah invoice diterbitkan untuk tetap dapat
                            menikmati layanan;</li>
                        <li>Invoice berikutnya akan diterbitkan maksimal tanggal 5 setiap bulannya dan harus dibayarkan
                            paling lambat tanggal 25 setiap bulannya;</li>
                        <li>Jika terjadi keterlambatan pembayaran Invoice, maka layanan akan otomatis dihentikan;</li>
                        <li>Pembayaran dianggap sah apabila telah diterima di rekening MEGADATA-ISP;</li>
                        <li>Tidak diterimanya lembar Invoice, tidak menghapus kewajiban Pelanggan untuk membayarkan
                            biaya langganan selama dalam jangka waktu berlangganan;</li>
                        <li>Pelanggan dapat membuat pengaduan atas Invoice maksimal 1 (satu) bulan sejak tanggal Invoice
                            diterbitkan.</li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>

    <!-- Page 3: Lanjutan Syarat dan Ketentuan -->
    <div class="terms-section">
        <div class="terms-content">
            <h3>PASAL 5 – HAK DAN KEWAJIBAN MEGADATA-ISP</h3>
            <p><strong>1. Hak MEGADATA-ISP</strong></p>
            <ol type="a">
                <li>Menerima pembayaran biaya-biaya sesuai dengan Pasal 4 Perjanjian ini;</li>
                <li>Memasang, memeriksa, mengganti, dan mengambil perangkat dan jaringan dari waktu ke waktu di Lokasi
                    Pelanggan;</li>
                <li>Melakukan de-aktivasi layanan dan/atau memutuskan Perjanjian secara sepihak jika Pelanggan melanggar
                    Pasal 4 dan Pasal 9 Perjanjian ini;</li>
                <li>Mendapatkan ganti rugi dari Pelanggan atas kerusakan/kehilangan perangkat milik MEGADATA-ISP akibat
                    kelalaian Pelanggan.</li>
            </ol>

            <p><strong>2. Kewajiban MEGADATA-ISP</strong></p>
            <ol type="a">
                <li>Meminjamkan perangkat dan melakukan instalasi sesuai spesifikasi layanan MEGADATA-ISP;</li>
                <li>Menyelenggarakan layanan sesuai dengan yang dipilih Pelanggan dalam Perjanjian;</li>
                <li>Menjaga dan memelihara layanan agar tetap berfungsi termasuk jika terjadi kerusakan perangkat yang
                    dipinjamkan kepada Pelanggan yang tidak diakibatkan oleh kelalaian Pelanggan maksimal dalam kurun
                    waktu 1 x 24 jam sejak dipastikan kerusakannya;</li>
                <li>Melayani dan menindaklanjuti keluhan Pelanggan secara professional.</li>
            </ol>

            <h3>PASAL 6 – HAK DAN KEWAJIBAN PELANGGAN</h3>
            <p><strong>1. Hak Pelanggan</strong></p>
            <ol type="a">
                <li>Menggunakan layanan sesuai dengan tipe layanan yang sudah dipilih;</li>
                <li>Mengajukan permintaan perubahan layanan dengan tetap mengikuti prosedur yang telah ditentukan;</li>
                <li>Melaporkan kerusakan/gangguan terhadap layanan termasuk kerusakan perangkat yang dipinjamkan.</li>
            </ol>

            <p><strong>2. Kewajiban Pelanggan</strong></p>
            <ol type="a">
                <li>Membayar biaya-biaya sesuai dengan Pasal 4 Perjanjian ini sesuai dengan tagihan dan tepat waktu;
                </li>
                <li>Menjaga dan merawat perangkat yang dipinjamkan MEGADATA-ISP dan mengembalikannya dalam kondisi baik
                    saat berhenti berlangganan;</li>
                <li>Melaporkan gangguan layanan dan/atau kerusakan perangkat dan jaringan yang terpasang di Lokasi
                    Pelanggan;</li>
                <li>Memberitahukan secara tertulis kepada MEGADATA-ISP jika ada perubahan data Pelanggan.</li>
            </ol>

            <h3>PASAL 7 – PERUBAHAN LAYANAN</h3>
            <p>Pelanggan dapat mengajukan permintaan perubahan layanan secara tertulis serta mengisi form yang
                disediakan. Permintaan perubahan layanan akan dilakukan setelah dilakukan pembayaran atas seluruh
                tagihan.</p>

            <h3>PASAL 8 – BERHENTI BERLANGGANAN</h3>
            <p>Pelanggan dapat mengajukan permintaan untuk berhenti berlangganan dengan syarat dan ketentuan sebagai
                berikut:</p>
            <ol>
                <li>Melakukan pengajuan tertulis menggunakan form yang telah disediakan dan melunasi seluruh tagihan
                    yang telah diterbitkan oleh MEGADATA-ISP.</li>
                <li>Pengajuan berhenti berlangganan sebelum masa kontrak berakhir, akan dikenakan biaya de-instalasi
                    sebesar Rp. 250.000,- (Dua Ratus Lima Puluh Ribu Rupiah);</li>
                <li>Jika saat pengajuan berhenti Pelanggan tidak dapat mengembalikan perangkat, maka Pelanggan akan
                    dikenakan denda ganti rugi sesuai dengan harga perangkat yang rusak tersebut.</li>
                <li>Pelanggan tidak bisa mengajukan refund atas biaya langganan yang sudah dibayarkan.</li>
                <li>Pihak megadata berhak menarik kembali semua alat yang berupa MODEM, ADAPTOR, dan Instalasi KABEL
                    Fiber Optik yang terpasang.</li>
            </ol>
        </div>
    </div>

    <!-- Page 4: Pasal Terakhir & Tanda Tangan -->
    <div class="terms-section">
        <div class="terms-content">
            <h3>PASAL 9 – DE-AKTIVASI LAYANAN DAN PEMUTUSAN LAYANAN</h3>
            <p>MEGADATA-ISP akan melakukan de-aktivasi layanan dan pemutusan apabila:</p>
            <ol>
                <li>De-aktivasi layanan otomatis apabila terjadi keterlambatan pembayaran tagihan layanan;</li>
                <li>De-aktivasi dan/atau pemutusan langganan apabila permintaan tertulis dari Pelanggan sesuai dengan
                    Pasal 8;</li>
                <li>Pemutusan langganan karena Pelanggan tidak melakukan pembayaran tagihan sesuai dengan Pasal 4;</li>
                <li>Ada rekomendasi dari MEGADATA-ISP terkait hal-hal yang bersifat teknis, force majeure yang
                    menyebabkan kualitas layanan tidak maksimal.</li>
            </ol>

            <h3>PASAL 10 – RE-AKTIVASI LAYANAN</h3>
            <ol>
                <li>Re-aktivasi layanan akan dilakukan setelah pelanggan melunasi seluruh tagihan yang belum
                    terbayarkan.</li>
                <li>Pelanggan yang sudah mengajukan berhenti berlangganan, jika ingin berlangganan kembali, mengikuti
                    proses seperti pendaftaran Pelanggan baru.</li>
            </ol>

            <h3>PASAL 11 – SANKSI</h3>
            <ol>
                <li>MEGADATA-ISP berhak melakukan de-aktivasi layanan jika Pelanggan melanggar ketentuan pembayaran;
                </li>
                <li>Pelanggan dilarang melakukan penyalahgunaan layanan untuk kegiatan yang melanggar hukum;</li>
                <li>Pelanggan dilarang melakukan penyambungan atau penambahan titik sambungan layanan keluar Lokasi
                    tanpa izin tertulis dari MEGADATA-ISP;</li>
                <li>Pelanggan dilarang mengganti konfigurasi teknis atas perangkat dan jaringan di Lokasi tanpa izin
                    tertulis dari MEGADATA-ISP;</li>
                <li>Pelanggan dilarang memindahtangankan penguasaan dan/atau penggunaan layanan kepada pihak lain tanpa
                    izin tertulis dari MEGADATA-ISP.</li>
            </ol>

            <h3>PASAL 12 – FORCE MAJEURE</h3>
            <p>MEGADATA-ISP dan Pelanggan dibebaskan dari kewajiban masing-masing berdasarkan Perjanjian ini apabila
                terjadi kondisi Force Majeure (Darurat) yang meliputi bencana alam, perang, pemberontakan, atau tindakan
                pemerintah yang mempengaruhi keberlangsungan penyelenggaraan layanan.</p>

            <h3>PASAL 13 – LAIN-LAIN</h3>
            <ol>
                <li>Apabila dalam pelaksanaan Perjanjian ini terdapat perdebatan pendapat atau perselisihan, maka
                    MEGADATA-ISP dan Pelanggan sepakat untuk mengutamakan penyelesaian secara musyawarah;</li>
                <li>Dalam hal tidak tercapai kesepakatan, kedua belah pihak sepakat untuk menyelesaikan perselisihan
                    melalui pengadilan negeri setempat.</li>
            </ol>
        </div>

        <!-- TANDA TANGAN -->
        <div class="signature-section">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <!-- KIRI: PELANGGAN -->
                    <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 0 20px;">
                        <div class="signature-container">
                            <p class="signature-label">Pelanggan</p>
                            <div class="signature-box">
                                @if ($beritaAcara->ttd_pelanggan)
                                    @php
                                        $ttdPath = $beritaAcara->ttd_pelanggan;
                                    @endphp
                                    @if (strpos($ttdPath, 'data:image') === 0)
                                        <img src="{{ $ttdPath }}" class="signature-img" alt="TTD Pelanggan">
                                    @elseif (Storage::disk('public')->exists($ttdPath))
                                        <img src="{{ public_path('storage/' . $ttdPath) }}" class="signature-img" alt="TTD Pelanggan">
                                    @else
                                        <div style="height: 80px; line-height: 80px; color: #999;">Tanda tangan tidak tersedia</div>
                                    @endif
                                @else
                                    <div style="height: 80px; line-height: 80px; color: #999;">Tanda tangan tidak tersedia</div>
                                @endif
                            </div>
                            <p class="signature-name">({{ strtoupper($beritaAcara->nama) }})</p>
                        </div>
                    </td>

                    <!-- KANAN: TEKNISI -->
                    <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 0 20px;">
                        <p style="font-size: 8pt; margin: 0 0 3px;">
                            Besuki: {{ \Carbon\Carbon::parse($beritaAcara->tanggal_registrasi)->format('d-M-Y') }}
                        </p>
                        <p style="margin: 0 0 10px; font-weight: bold;">PT. MEGA ARTHA LINTAS DATA</p>

                        <div class="signature-container">
                            <p class="signature-label">Teknisi</p>
                            <div class="signature-box">
                                @php
                                    $ttdPetugasPath = $beritaAcara->ttd_petugas;
                                    $imgTeknisi = null;
                                    if ($ttdPetugasPath) {
                                        if (strpos($ttdPetugasPath, 'data:image') === 0) {
                                            $imgTeknisi = $ttdPetugasPath;
                                        } else {
                                            $filePath = storage_path('app/public/' . $ttdPetugasPath);
                                            if (file_exists($filePath)) {
                                                $type = pathinfo($filePath, PATHINFO_EXTENSION);
                                                $data = file_get_contents($filePath);
                                                $imgTeknisi = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                            }
                                        }
                                    }
                                @endphp
                                @if ($imgTeknisi)
                                    <img src="{{ $imgTeknisi }}" class="signature-img" alt="TTD Teknisi">
                                @else
                                    <div style="height: 80px; line-height: 80px; color: #999;">Tanda tangan tidak tersedia</div>
                                @endif
                            </div>
                            <p class="signature-name">({{ strtoupper($beritaAcara->nama_teknisi_1) }})</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Page 5: Foto Dokumentasi -->
    <div class="photo-section">
        <div class="photo-title">FOTO DOKUMENTASI</div>

        <!-- Baris pertama: Foto Rumah dan Foto ODP -->
        <div class="photo-grid">
            <div class="photo-row">
                <div class="photo-item">
                    @if ($beritaAcara->foto_rumah && Storage::disk('public')->exists($beritaAcara->foto_rumah))
                        <img src="{{ public_path('storage/' . $beritaAcara->foto_rumah) }}" alt="Foto Rumah">
                        <p>Foto Rumah</p>
                    @else
                        <div class="no-photo">Foto Rumah<br>Tidak Tersedia</div>
                    @endif
                </div>

                <div class="photo-item">
                    @if ($beritaAcara->foto_odp && Storage::disk('public')->exists($beritaAcara->foto_odp))
                        <img src="{{ public_path('storage/' . $beritaAcara->foto_odp) }}" alt="Foto ODP">
                        <p>Foto ODP</p>
                    @else
                        <div class="no-photo">Foto ODP<br>Tidak Tersedia</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Baris kedua: Foto Pelanggan (di tengah) -->
        <div class="photo-grid" style="margin-top: 20px;">
            <div class="photo-row">
                <div class="photo-item" style="width: 100%; text-align: center;">
                    <div style="display: inline-block; width: 33.33%; vertical-align: top;">
                        @if ($beritaAcara->foto_pelanggan && Storage::disk('public')->exists($beritaAcara->foto_pelanggan))
                            <img src="{{ public_path('storage/' . $beritaAcara->foto_pelanggan) }}" alt="Foto Pelanggan">
                            <p>Foto Pelanggan</p>
                        @else
                            <div class="no-photo">Foto Pelanggan<br>Tidak Tersedia</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p><strong>PT. MEGA ARTHA LINTAS DATA</strong></p>
            <p>Kp. Bringin Ds. Langkap RT 01 RW 02 Kec. Besuki Kab. Situbondo Jawa Timur (68356)</p>
            <p>(085186823005) | helpdesk@megadata.net.id | megadata.net.id</p>
            <p>IG : @megadata.isp_besuki | TikTok : @megadata.isp_besuki</p>
        </div>
    </div>
</body>
</html>