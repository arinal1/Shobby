@if ($users == null || $users->isEmpty())
    <p class="text-center" style="margin:8rem;">
        <b>Tidak ada data user</b>
    </p>
@else
    <table class="table table-hover">
        <thead>
            <tr class="table-defaul">
                <th>ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Waktu Terdaftar</th>
                <th>Waktu Terupdate</th>
                @if (Auth::user()->hasRole('owner'))
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody class="scrollable">
            @foreach ($users as $user)
                <tr class="table-default scrollable">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    @if (Auth::user()->hasRole('owner'))
                        <td>
                            <button class="btn btn-danger bi bi-trash"
                                onclick="showDeleteModal('{{ route('user.delete') }}','{{ $user->id }}','{{ 'User ' . $user->name }}')"></button>
                            <a class="btn btn-success bi bi-pencil-square"
                                href="{{ route('user.detail', [$user->id]) }}"></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="row justify-content-evenly" style="padding-top: 2rem; margin: 0;">
    <div class="col text-center">
        <a href="{{ route('user.detail') }}" class="btn btn-success" style="width: 100%;">Tambah User</a>
    </div>
</div>
