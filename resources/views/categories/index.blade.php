<!-- Các tệp CSS của Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Các tệp JavaScript của Bootstrap (bao gồm jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<h4>Trang chủ danh mục</h4>
<!-- Product List Table -->
<div class="col">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> thêm mới
    </a>
</div>
@if (session('success') || session('error'))
    <div class="card-header pt-2 pb-0">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <script>
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 2000); // Thời gian trễ 2 giây (2000ms)
    </script>
@endif

<div class="card">
    <div class="card-body">
        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive text-nowrap ">
                <table class="table table-bordered border-top">
                    <form action="{{ route('categories.index') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <thead>
                            <tr>
                                <th>TT</th>
                                <th>Tên</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach( $items as $key => $category )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status }}</td>

                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.min.css">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.min.js"></script>
                                    @if (session('successMessage'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: '<h6>{{ session('successMessage') }}</h6>',
                                            showConfirmButton: false,
                                            timer: 2000,
                                            width: '300px',
                                            customClass: {
                                                popup: 'animated bounce',
                                            },
                                            background: '#F4F4F4',
                                            iconColor: '#00A65A',
                                        });
                                    </script>
                                    @endif

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('categories.edit',$category->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                    </form>


                    <form method="POST" action="{{route('categories.destroy' ,$category->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item"><i class="bx bx-trash me-1" onclick="return confirm('Bạn có muốn xóa ?')"></i> Delete</button>
                    </form>
            </div>
        </div>
        </td>
    </div>
    </tr>
    @endforeach
    </tbody>
    </table>
    </form>

</div>
</div>

<!-- Pagination -->
<div class="card-footer pt-1 pb-1">
    <div class="float-end">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>

</div>
</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Đăng xuất</button>
</form>
