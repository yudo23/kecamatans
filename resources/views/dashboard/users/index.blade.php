@extends("dashboard.layouts.main")

@section("title","Users")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Users</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30 px-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary btn-sm btn-add"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="#" class="btn btn-success btn-sm btn-filter"><i class="fa fa-filter"></i> Filter</a>
                        <a href="{{route('dashboard.users.index')}}" class="btn @if(!empty(request()->all())) btn-warning @else btn-secondary @endif btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="table">
                                <table class="table mb-3 table-striped table-bordred">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Dibuat Pada</th>
                                    </thead>
                                    <tbody>
                                    @forelse($table as $index => $row)
                                    <tr>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></button>
                                                <div class="dropdown-menu">
                                                    <a href="{{route('dashboard.users.show',$row->id)}}" class="dropdown-item"><i class="fa fa-eye"></i> Show</a>
                                                    <a href="{{route('dashboard.users.edit',$row->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                                    @if($row->trashed())
                                                    <a href="#" class="dropdown-item btn-restore" data-id="{{$row->id}}"><i class="fa fa-undo"></i> Restore</a>
                                                    @else
                                                        @if(Auth::user()->id != $row->id)
                                                        <a href="#" class="dropdown-item btn-delete" data-id="{{$row->id}}"><i class="fa fa-trash"></i> Hapus</a>
                                                        @endif
                                                    @endif

                                                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN]) && $row->id != Auth::user()->id && !empty($row->email_verified_at))
                                                        <a href="{{ route('dashboard.users.impersonate', $row->id) }}" class="dropdown-item" onclick="return confirm('Apakah anda yakin?');">
                                                            <i class="fa fa-sign-in"> Login</i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$table->firstItem() + $index}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->getRoleNames()->implode(', ') }}</td>
                                        <td>
                                            <span class="badge bg-{{$row->status()->class ?? null}}">{{$row->status()->msg ?? null}}</span>
                                        </td>
                                        <td>{{date('d-m-Y H:i:s',strtotime($row->created_at))}}</td>
                                    </tr> 
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No data</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $table->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("dashboard.users.modal.index")

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id" />
</form>

<form id="frmRestore" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" />
</form>

@endsection

@section("script")
<script>
    $(function() {
        $(document).on("click", ".btn-filter", function(e) {
            e.preventDefault();

            $("#modalFilter").modal("show");
        });

        $(document).on("click", ".btn-delete", function() {
            let id = $(this).data("id");
            if (confirm("Apakah anda yakin ingin menghapus data ini ?")) {
                $("#frmDelete").attr("action", "{{ route('dashboard.users.destroy', '_id_') }}".replace("_id_", id));
                $("#frmDelete").find('input[name="id"]').val(id);
                $("#frmDelete").submit();
            }
        })

        $(document).on("click", ".btn-restore", function() {
            let id = $(this).data("id");
            if (confirm("Apakah anda yakin ingin mengembalikan data ini ?")) {
                $("#frmRestore").attr("action", "{{ route('dashboard.users.restore', '_id_') }}".replace("_id_", id));
                $("#frmRestore").find('input[name="id"]').val(id);
                $("#frmRestore").submit();
            }
        })
    })
</script>
@endsection