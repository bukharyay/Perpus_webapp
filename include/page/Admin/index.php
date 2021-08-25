<button class="btn btn-primary my-2">Tambah</button>

<table id="example" class="table table-striped" style="white-space:nowrap;" width="100%">
    <thead align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody align="center">
        <?php
        $no = 1;
        $sql = $koneksi->query("SELECT * FROM `tb_user`");
        ?>

        <?php foreach ($sql as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_user']; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['level']; ?></td>
                <td>
                    <button class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
    <tfoot align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>