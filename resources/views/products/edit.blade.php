<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Chỉnh sửa </span>
    </h4>
    <form action="{{route('products.update' , $item->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="app-ecommerce">
            <!-- Add Product -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column justify-content-center">

                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <a href="{{route('products.index')}}" class="btn btn-label-secondary">Trở Về</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>

                </div>
            </div>
            <div class="row">
                <!-- First column-->
                <div class="col-12 col-lg-12">
                    <!-- Product Information -->
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="row mb-10">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control" placeholder="Tên" name="name" value="{{ $item->name }}">
                                        @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Giá</label>
                                        <input type="text" class="form-control" placeholder="Giá" name="price" value="{{ $item->price }}">
                                        @error('price') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                    <div class="mb-3">
                                        <label class="form-label">Danh mục</label>
                                        <select name="category_id" class="form-select" style="width: 340%;">
                                            <option value="">Vui lòng chọn</option>
                                            @foreach($categories as $index => $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $item->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label mb-1" for="status-org">Trạng thái </label>
                                        <select class="form-control" name="status">
                                            <option value="">Tất cả</option>
                                            <option {{ $item->status == 'còn' ? 'selected' : '' }} value="còn">còn</option>
                                            <option {{ $item->status == 'hết' ? 'selected' : '' }} value="hết">hết</option>
                                        </select>
                                        @error('status') <div class="alert alert-danger">{{ $message }}</div> @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
