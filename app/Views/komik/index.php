<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/create" class="btn btn-primary mt-3">Tambah data komik</a>
            <h2 class="mt-2">Daftar komik</h2>
            <?php if (session()->getFlashdata('pesan')) { ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php } ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($komik as $kom => $k) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><img src="<?= base_url(); ?>/img/<?= $k->sampul ?>" alt="<?= $k->judul; ?>" class="sampul"></td>
                            <td><?= $k->judul; ?></td>
                            <td>
                                <a href="/komik/<?= $k->slug; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>