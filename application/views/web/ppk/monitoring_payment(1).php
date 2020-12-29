<div class="container mt-5 mb-5">
    <div class="row">
        <div class="alert-text">
            <label class="font-weight-boldest text-success h2">Monitoring Pendanaan Pengadaan PSN</label>
        </div>
    </div>
    <div class="row justify-content-between mt-5 mb-5">
        <div class="col-4-md">
            <button type="button" class="btn btn-outline-success btn-lg mr-5 active">Monitoring SPP</button>
            <button type="button" class="btn btn-outline-success btn-lg mr-5">Monitoring Sisa Alokasi</button>
            <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
        </div>
        <div class="input-icon">
            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" /> <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>

        </div>
    </div>
</div>
<!--<div class="card card-custom gutter-b mb-4">-->
<!--    <div class="card-header">-->
<!--        <div class="card-title">-->
<!--            <div class="card-body">-->
<!--                 <h3 class="card-label">No. SPP : <span>TN 124</span></h3>-->

<!--                 <h3 class="card-label mt-5">Nama PSN : <span>Jalan Tol Bakauheni</span></h3>-->

<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-title">-->
<!--             <h3 class="card-label mb-5">COST OF FUNDING</h3>-->

<!--        </div>-->
<!--    </div>-->
<!--    <div class="card-title ml-5">-->
<!--        <div class="card-body">-->
<!--             <h3 class="card-label">Status : <span class="text-warning font-weight-bolder"> Menunggu Pembayaran Cost of Funding</span></h3>-->

<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <div class="card-body">
                 <h3 class="card-label">No. SPP : <span id="spp_num">TN 124</span></h3>

                 <h3 class="card-label mt-5">Nama PSN : <span id="psn_name">Jalan Tol Citareum</span></h3>

            </div>
        </div>
        <div class="card-title">
             <h3 class="card-label">JENIS PEMBAYARAN : <span id="payment_type"></span></h3>

        </div>
    </div>
    <div class="card-header">
        <div class="card-title ml-5 mt-5">
             <h3 class="card-label mb-5">Permohonan Status : <span class="text-warning font-weight-bolder" id="request_status"></span></h3>

        </div>
        <!--<p class="card-label font-size-h5 mt-5">Surat Keputusan Pembayaran Dana <span>No. 125</span></p>-->
    </div>
    <div class="card-body">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom">
                            <div class="wizard-steps p-8 p-lg-10">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title text-success">Input Dokumen SPP</h4>
                                            <i class="far fa-check-circle icon-3x text-success mt-5 mb-5"></i>

                                         <h4 class="wizard-title text-success">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title text-primary">Pilih Bidang</h4>
                                        <i class="far fa-check-circle icon-3x text-primary mt-5 mb-5"></i>

                                         <h4 class="wizard-title text-primary">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title text-primary">Review Dan Kirim</h4>
                                            <i class="far fa-check-circle icon-3x text-primary mt-3 mb-5"></i>

                                         <h4 class="wizard-title text-primary">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title text-primary">Penelitian Administrasi</h4>
                                        <i class="far fa-check-circle icon-3x text-primary mt-3 mb-5"></i>

                                         <h4 class="wizard-title text-primary">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title">Persetujuan Pembayaran</h4>
                                            <i class="far fa-check-circle icon-3x mt-3 mb-5"></i>

                                         <h4 class="wizard-title">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                         <h4 class="wizard-title">Transfer</h4>
                                            <i class="far fa-check-circle icon-3x mt-3 mb-5"></i>

                                         <h4 class="wizard-title">10/06/20</h4>

                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow last">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                </div>
                                <!--end::Wizard Step 5 Nav-->
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                    </div>
                </div>
            </div>
            <div class="alert alert-custom alert-notice alert-light-warning fade show text-right" role="alert">
                <div class="alert-text text-dark font-weight-bold">Surat Keputusan Pembayaran Lahan</div>
                <div class="alert-close"> <a href="#" class="btn btn-outline-success btn-lg font-weight-bold btn-pill mr-5">LIHAT</a>
                <a href="#" class="btn btn-success btn-lg font-weight-bold btn-pill">DOWNLOAD</a>

            </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="alert-text">
                    <label class="font-weight-boldest text-success h3">HISTORI PER BIDANG</label>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="mt-5">
                    <button type="button" class="btn btn-outline-success btn-lg mr-5" id="btnProcess">Sedang Diproses</button>
                    <button type="button" class="btn btn-outline-success btn-lg mr-5" id="btnApproved">Diterima</button>
                    <button type="button" class="btn btn-outline-success btn-lg" id="btnRejected">Tertolak</button>
                </div>
                <div>
                    <br>
                    <p class="text-success font-weight-bold h5">Lihat Daftar Surat Keputusan</p>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover table-fixed" id="tableMonitoringSpp">
                <!-- Table head -->
                <thead class="btn-lman">
                    <tr>
                        <th>No.</th>
                        <th>Nama Bidang</th>
                        <th>Nama PSN</th>
                        <th>Jenis Bidang</th>
                        <th>Luas</th>
                        <th>Harga/Nilai Tambah</th>
                        <th>Nama Yang Berhak</th>
                        <th>Tanggal Di Proses</th>
                        <th>Tanggal Keputusan</th>
                        <th>Surat Keputusan</th>
                    </tr>
                </thead>
                <!-- Table head -->
                <!-- Table body -->
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                        <td>20 Hari</td>
                        <td>Rp. 50.000,00</td>
                        <td>Rp. 123.678.900,00</td>
                        <td>Rp. 10.678.900,00</td>
                        <td><button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                        <td>20 Hari</td>
                        <td>Rp. 50.000,00</td>
                        <td>Rp. 123.678.900,00</td>
                        <td>Rp. 10.678.900,00</td>
                        <td>
                            <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                        <td>20 Hari</td>
                        <td>Rp. 50.000,00</td>
                        <td>Rp. 123.678.900,00</td>
                        <td>Rp. 10.678.900,00</td>
                        <td>
                            <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                        <td>20 Hari</td>
                        <td>Rp. 50.000,00</td>
                        <td>Rp. 123.678.900,00</td>
                        <td>Rp. 10.678.900,00</td>
                        <td>
                            <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                        <td>20 Hari</td>
                        <td>Rp. 50.000,00</td>
                        <td>Rp. 123.678.900,00</td>
                        <td>Rp. 10.678.900,00</td>
                        <td>
                            <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>
                    </tr>
                </tbody>
                <!-- Table body -->
            </table>
            <br>
            <!-- Table -->
            <!--<div class="container mt-5 mb-5">-->
            <!--    <div class="row">-->
            <!--        <div class="alert-text">-->
            <!--            <label class="font-weight-boldest text-success h3">STATUS COST OF FUNDING</label>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="row">-->
            <!--        <div class="mt-5 mb-5">-->
            <!--            <div class="table-responsive text-nowrap">-->
            <!--                <table class="table table-bordered table-hover table-fixed">-->
                                <!-- Table head -->
            <!--                    <thead class="btn-lman">-->
            <!--                        <tr>-->
            <!--                            <th>No.</th>-->
            <!--                            <th>Jenis Bidang</th>-->
            <!--                            <th>Nomor Urut Nominatif</th>-->
            <!--                            <th>Luas Bidang</th>-->
            <!--                            <th>Tanggal Diapprove</th>-->
            <!--                            <th>Total Durasi Hari Setelah Diapprove</th>-->
            <!--                            <th>Nilai Bunga Per Hari</th>-->
            <!--                            <th>Harga/Nilai Tanah</th>-->
            <!--                            <th>Total Bunga</th>-->
            <!--                            <th>Status Cost of Founding</th>-->
            <!--                            <th>Detail Bidang</th>-->
            <!--                        </tr>-->
            <!--                    </thead>-->
                                <!-- Table head -->
                                <!-- Table body -->
            <!--                    <tbody>-->
            <!--                        <tr>-->
            <!--                            <th scope="row">1</th>-->
            <!--                            <td>Non Bidang</td>-->
            <!--                            <td>12345676678</td>-->
            <!--                            <td>1343 m2</td>-->
            <!--                            <td>1 Juni 2020</td>-->
            <!--                            <td>20 Hari</td>-->
            <!--                            <td>Rp. 50.000,00</td>-->
            <!--                            <td>Rp. 123.678.900,00</td>-->
            <!--                            <td>Rp. 10.678.900,00</td>-->
            <!--                            <td>Belum terbayar</td>-->
            <!--                            <td>-->
            <!--                                <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>-->
            <!--                        </tr>-->
            <!--                        <tr>-->
            <!--                            <th scope="row">2</th>-->
            <!--                            <td>Non Bidang</td>-->
            <!--                            <td>12345676678</td>-->
            <!--                            <td>1343 m2</td>-->
            <!--                            <td>1 Juni 2020</td>-->
            <!--                            <td>20 Hari</td>-->
            <!--                            <td>Rp. 50.000,00</td>-->
            <!--                            <td>Rp. 123.678.900,00</td>-->
            <!--                            <td>Rp. 10.678.900,00</td>-->
            <!--                            <td>Belum terbayar</td>-->
            <!--                            <td>-->
            <!--                                <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>-->
            <!--                        </tr>-->
            <!--                        <tr>-->
            <!--                            <th scope="row">3</th>-->
            <!--                            <td>Non Bidang</td>-->
            <!--                            <td>12345676678</td>-->
            <!--                            <td>1343 m2</td>-->
            <!--                            <td>1 Juni 2020</td>-->
            <!--                            <td>20 Hari</td>-->
            <!--                            <td>Rp. 50.000,00</td>-->
            <!--                            <td>Rp. 123.678.900,00</td>-->
            <!--                            <td>Rp. 10.678.900,00</td>-->
            <!--                            <td>Belum terbayar</td>-->
            <!--                            <td>-->
            <!--                                <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>-->
            <!--                        </tr>-->
            <!--                        <tr>-->
            <!--                            <th scope="row">4</th>-->
            <!--                            <td>Non Bidang</td>-->
            <!--                            <td>12345676678</td>-->
            <!--                            <td>1343 m2</td>-->
            <!--                            <td>1 Juni 2020</td>-->
            <!--                            <td>20 Hari</td>-->
            <!--                            <td>Rp. 50.000,00</td>-->
            <!--                            <td>Rp. 123.678.900,00</td>-->
            <!--                            <td>Rp. 10.678.900,00</td>-->
            <!--                            <td>Belum terbayar</td>-->
            <!--                            <td>-->
            <!--                                <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>-->
            <!--                        </tr>-->
            <!--                        <tr>-->
            <!--                            <th scope="row">5</th>-->
            <!--                            <td>Non Bidang</td>-->
            <!--                            <td>12345676678</td>-->
            <!--                            <td>1343 m2</td>-->
            <!--                            <td>1 Juni 2020</td>-->
            <!--                            <td>20 Hari</td>-->
            <!--                            <td>Rp. 50.000,00</td>-->
            <!--                            <td>Rp. 123.678.900,00</td>-->
            <!--                            <td>Rp. 10.678.900,00</td>-->
            <!--                            <td>Belum terbayar</td>-->
            <!--                            <td>-->
            <!--                                <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md">Lihat Detail</button></td>-->
            <!--                        </tr>-->
            <!--                    </tbody>-->
                                <!-- Table body -->
            <!--                </table>-->
                            <!-- Table -->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
</div>
    <?php if (isset($js)) { foreach ($js as $js) { ?>
    <script type="text/javascript" src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH . $js;
                                                ?>"></script>
    <?php } } ?>