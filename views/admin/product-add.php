<section class="content">
<form action="/admin/san-pham/them-moi?action=add" method="post">
    <div class="row">
      
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả ngắn</label>
                            <textarea class="form-control" name="short_des" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select class="form-control custom-select">
                                <option selected disabled>Chọn trạng thái</option>
                                <option>Bắt đầu bán</option>
                                <option>Chưa bán</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputProjectLeader">Số lượng kho</label>
                            <input type="text" name="in_stock" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Danh sách danh mục</label>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Giá</label>
                            <input type="text" name="price" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Hình ảnh</label>
                            <input type="file" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
      
    </div>
    <button type="submit" class="form-control submit_product btn-primary">Save</button>
    </form>
</section>
