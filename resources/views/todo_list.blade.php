<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">TODO LIST</h1>

        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalcreate">
            + Tambah List
        </button>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Prioritas</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Aksi</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($todo_list as $todo)
                    <tr class="text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-capitalize">
                            @if ($todo->status == 'selesai')
                                <strike>{{ $todo->nama }}</strike>
                            @else
                                {{ $todo->nama }}
                            @endif
                        </td>
                        <td>
                            @if ($todo->prioritas == 'rendah')
                                <span class="badge bg-primary">Rendah</span>
                            @elseif ($todo->prioritas == 'sedang')
                                <span class="badge bg-warning">Sedang</span>
                            @else
                                <span class="badge bg-danger">Tinggi</span>
                            @endif
                        </td>
                        <td>{{ $todo->tgl_ditambahkan }}</td>
                        <td>
                            @if ($todo->status == 'belum selesai')
                                <form action="{{ route('todo.done', $todo->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button class="btn btn-success btn-sm">✅ Selesai</button>
                                </form>
                            @else
                                <form action="{{ route('todo.undo', $todo->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button class="btn btn-warning btn-sm">🔄 Kembalikan</button>
                                </form>
                            @endif
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modaledit{{ $todo->id }}">✏ Edit</button>
                            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus list ini?')">🗑
                                    Hapus</button>
                            </form>
                        </td>
                        <td>{{ $todo->tgl_ditandai ? $todo->tgl_ditandai : '-' }}</td>
                    </tr>

                    <div class="modal fade" id="modaledit{{ $todo->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Todo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Nama:</label>
                                        <input type="text" name="nama" value="{{ $todo->nama }}"
                                            class="form-control" required>
                                        <br>
                                        <label>Prioritas:</label>
                                        <select class="form-control" name="prioritas">
                                            <option value="rengah" {{ $todo->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                            <option value="sedang" {{ $todo->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                            <option value="tinggi" {{ $todo->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modalcreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Todo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control" required>
                        <br>
                        <label>Prioritas:</label>
                        <select class="form-control" name="prioritas" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>  
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
