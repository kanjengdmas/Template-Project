<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Pemeriksaan Baru</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Keluhan Pasien</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pasien/pemeriksaan') ?>" method="post">
                    <h5 class="font-weight-bold text-secondary mb-3">Tujuan Spesialisasi</h5>
                    <div class="row mb-4">
                        <div class="col-md-12 form-group">
                            <label>Pilih Dokter / Spesialisasi <span class="text-danger">*</span></label>
                            <select class="form-control" name="dokter_id" required>
                                <option value="">-- Pilih Dokter & Spesialisasi --</option>
                                <?php foreach($dokters as $d): ?>
                                    <option value="<?= $d->user_id ?>" <?= set_value('dokter_id') == $d->user_id ? 'selected' : '' ?>>
                                        <?= $d->nama ?> - <?= $d->spesialis ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('dokter_id', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <h5 class="font-weight-bold text-secondary mb-3">Data Pribadi</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control bg-light" value="<?= $this->session->userdata('nama') ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Umur (Tahun) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="umur" value="<?= set_value('umur') ?>" required>
                            <?= form_error('umur', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" <?= set_value('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= set_value('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telp" value="<?= set_value('no_telp') ?>" required>
                            <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-12 form-group">
                            <label>Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="2" required><?= set_value('alamat') ?></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <hr>
                    <h5 class="font-weight-bold text-secondary mb-3 mt-4">Data Tambahan (Opsional)</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Berat Badan (kg)</label>
                            <input type="number" step="0.1" class="form-control" name="berat_badan" value="<?= set_value('berat_badan') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" class="form-control" name="tinggi_badan" value="<?= set_value('tinggi_badan') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tekanan Darah (cth: 120/80)</label>
                            <input type="text" class="form-control" name="tekanan_darah" value="<?= set_value('tekanan_darah') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Gula Darah</label>
                            <input type="text" class="form-control" name="gula_darah" value="<?= set_value('gula_darah') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Riwayat Penyakit Sebelumnya</label>
                            <textarea class="form-control" name="riwayat_penyakit" rows="2"><?= set_value('riwayat_penyakit') ?></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Riwayat Alergi (Obat/Makanan)</label>
                            <textarea class="form-control" name="riwayat_alergi" rows="2"><?= set_value('riwayat_alergi') ?></textarea>
                        </div>
                    </div>

                    <hr>
                    <h5 class="font-weight-bold text-secondary mb-3 mt-4">Keluhan Utama</h5>
                    <div class="form-group">
                        <label>Jelaskan secara detail keluhan yang Anda rasakan saat ini <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keluhan" rows="4" required placeholder="Cth: Batuk berdahak dan demam tinggi sejak 3 hari yang lalu..."><?= set_value('keluhan') ?></textarea>
                        <?= form_error('keluhan', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill"><i class="fas fa-paper-plane mr-2"></i> Kirim Pemeriksaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> Pastikan Anda mengisi data yang bertanda bintang (*) dengan benar.
                </div>
                <p>Data Anda akan dikirim ke Petugas untuk diverifikasi terlebih dahulu sebelum diteruskan ke Dokter.</p>
                <p class="mb-0">Mohon lengkapi bagian <strong>Data Tambahan</strong> jika Anda mengetahuinya, karena sangat membantu Dokter dalam mendiagnosis.</p>
            </div>
        </div>
    </div>
</div>
