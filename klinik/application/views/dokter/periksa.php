<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Diagnosis & Resep</h1>
    <a href="<?= base_url('dokter/pemeriksaan') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<form action="<?= base_url('dokter/simpan_periksa') ?>" method="post">
    <input type="hidden" name="pemeriksaan_id" value="<?= $p->id ?>">
    
    <div class="row">
        <!-- Informasi Pasien -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><th width="40%">Nama</th><td>: <?= $p->nama_pasien ?></td></tr>
                        <tr><th>Umur</th><td>: <?= $p->umur ?> Tahun</td></tr>
                        <tr><th>Jenis Kelamin</th><td>: <?= $p->jenis_kelamin ?></td></tr>
                        <tr><th>Telepon</th><td>: <?= $p->no_telp ?></td></tr>
                        <tr><th>Alamat</th><td>: <?= $p->alamat ?></td></tr>
                    </table>
                    <hr>
                    <h6 class="font-weight-bold">Data Medis Fisik:</h6>
                    <table class="table table-sm table-borderless">
                        <tr><th width="50%">Berat Badan</th><td>: <?= $p->berat_badan ? $p->berat_badan.' kg' : '-' ?></td></tr>
                        <tr><th>Tinggi Badan</th><td>: <?= $p->tinggi_badan ? $p->tinggi_badan.' cm' : '-' ?></td></tr>
                        <tr><th>Tekanan Darah</th><td>: <?= $p->tekanan_darah ? $p->tekanan_darah : '-' ?></td></tr>
                        <tr><th>Gula Darah</th><td>: <?= $p->gula_darah ? $p->gula_darah : '-' ?></td></tr>
                    </table>
                    <hr>
                    <h6 class="font-weight-bold text-danger">Riwayat Medis:</h6>
                    <p class="mb-1"><strong>Penyakit:</strong> <?= $p->riwayat_penyakit ? $p->riwayat_penyakit : '-' ?></p>
                    <p class="mb-0"><strong>Alergi:</strong> <?= $p->riwayat_alergi ? $p->riwayat_alergi : '-' ?></p>
                </div>
            </div>
            
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Keluhan Pasien</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0"><?= nl2br($p->keluhan) ?></p>
                </div>
            </div>
        </div>

        <!-- Form Diagnosis & Resep -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Pemeriksaan Dokter</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold text-success">Diagnosis <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="diagnosis" rows="4" required placeholder="Tuliskan hasil diagnosis di sini..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold text-info">Saran Medis <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="saran" rows="3" required placeholder="Tuliskan anjuran/saran untuk pasien (cth: Perbanyak minum air, istirahat cukup)..."></textarea>
                    </div>

                    <hr>
                    <h5 class="font-weight-bold text-primary mt-4 mb-3"><i class="fas fa-pills mr-2"></i> Resep Obat Digital</h5>
                    
                    <div id="resep-container">
                        <div class="row resep-row mb-3 border-bottom pb-3">
                            <div class="col-md-4">
                                <label>Pilih Obat</label>
                                <select class="form-control obat-select" name="obat_id[]">
                                    <option value="">-- Pilih Obat --</option>
                                    <?php foreach($obat as $o): ?>
                                        <option value="<?= $o->id ?>" data-stok="<?= $o->stok ?>" <?= $o->stok <= 0 ? 'disabled' : '' ?>>
                                            <?= $o->nama_obat ?> (<?= $o->jenis_obat ?>) - Stok: <?= $o->stok ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah[]" min="1" value="1" required>
                            </div>
                            <div class="col-md-4">
                                <label>Aturan Pakai</label>
                                <input type="text" class="form-control" name="aturan_pakai[]" placeholder="Cth: 3x sehari sesudah makan">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-remove-resep" style="display:none;"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-resep"><i class="fas fa-plus"></i> Tambah Obat Lain</button>
                    
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary btn-lg" onclick="return confirm('Simpan hasil pemeriksaan ini? Status akan diubah menjadi Selesai.')"><i class="fas fa-save mr-2"></i> Simpan & Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('resep-container');
    const btnAdd = document.getElementById('btn-add-resep');
    
    // Original template
    const templateRow = container.querySelector('.resep-row').cloneNode(true);
    templateRow.querySelector('select').value = '';
    templateRow.querySelector('input').value = '';
    templateRow.querySelector('.btn-remove-resep').style.display = 'block';

    btnAdd.addEventListener('click', function() {
        const newRow = templateRow.cloneNode(true);
        container.appendChild(newRow);
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-resep')) {
            e.target.closest('.resep-row').remove();
        }
    });
});
</script>
