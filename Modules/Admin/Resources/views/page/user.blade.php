@extends('admin::layouts.simple-admin')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Thu Nhập</th>
              <th>Hình Thức Vay</th>
              <th>Số Tiền Vay</th>
              <th>Ngày Tạo</th>
              <th>Note</th>
              <th>Trạng Thái</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Thu Nhập</th>
              <th>Hình Thức Vay</th>
              <th>Số Tiền Vay</th>
              <th>Ngày Tạo</th>
              <th>Note</th>
              <th>Trạng Thái</th>
              <th>Edit</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($userInfor as $user)
            <tr id="data-id-{{$user->id}}">
              <td class="data-name">{{ $user->name }}</td>
              <td class="data-phone">{{ $user->phone }}</td>
              <td class="data-mail">{{ $user->mail }}</td>
              <td class="data-thunhap">{{ $user->thunhap }}</td>
              <td class="data-hinhthucvay">{{ $user->hinhthucvay }}</td>
              <td class="data-sotienvay">{{ $user->sotienvay }}</td>
              <td>{{ $user->created_at }}</td>
              <td class="data-note">{{ $user->note }}</td>
              <td class="data-status">
                @switch($user->status)
                  @case(0)
                      <span class="btn btn-primary btn-sm">New</span>
                      @break 
                  @case(1)
                      <span class="btn btn-info btn-sm">Called</span>
                      @break 
                  @case(2)
                      <span class="btn btn-success btn-sm">Success</span>
                      @break
                  @case(3)
                      <span class="btn btn-danger btn-sm">False</span>
                      @break
                  @default
                      <span class="btn btn-primary btn-sm">New</span>
              @endswitch
              </td>
              <td class="data-edit">
                <span class="btn btn-primary btn-sm edit-user" 
                  data-userid="{{$user->id}}" 
                  data-name="{{ $user->name }}"
                  data-phone="{{ $user->phone }}"
                  data-mail="{{ $user->mail }}"
                  data-thunhap="{{ $user->thunhap }}"
                  data-hinhthucvay="{{ $user->hinhthucvay }}"
                  data-sotienvay="{{ $user->sotienvay }}"
                  data-note="{{ $user->note }}"
                  data-status="{{ $user->status }}"><i class="fas fa-edit"></i> Edit</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <form method="POST" action="{{ route('admin.editUserInfor') }}" id="formEditUser">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="userId">
      <div class="modal-content">
        <div class="modal-body">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
              <label for="mail">Address:</label>
              <input type="text" class="form-control" id="mail" name="mail">
            </div>
            <div class="form-group">
              <label for="thunhap">Thu nhâp:</label>
              <select class="form-control" name="thunhap" id="thunhap">
                <option value="">Thu nhập hàng tháng</option>
                <option value="Dưới 7 triệu">Dưới 7 triệu</option>
                <option value="Từ 7 đến 12 triệu">Từ 7 đến 12 triệu</option>
                <option value="Trên 12 triệu">Trên 12 triệu</option>
              </select>
            </div>
            <div class="form-group">
              <label for="hinhthucvay">Hình thức vay:</label>
              <select class="form-control" name="hinhthucvay" id="hinhthucvay">
                <option value="g">Hình thức vay</option>
                <option value="Vay theo lương">Vay theo lương</option>
                <option value="Vay theo hộ kinh doanh">Vay theo hộ kinh doanh</option>
                <option value="Vay theo hóa đơn tiện ích">Vay theo hóa đơn tiện ích</option>
                <option value="Vay theo hợp đồng tín dụng cũ">Vay theo hợp đồng tín dụng cũ</option>
                <option value="Vay theo bảo hiểm nhân thọ">Vay theo bảo hiểm nhân thọ</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sotienvay">Số tiền vay:</label>
              <select class="form-control" name="sotienvay" id="sotienvay">
                <option value="Khoản vay mong muốn">Khoản vay mong muốn</option>
                <option value="Dưới 30 triệu">Dưới 30 triệu</option>
                <option value="Từ 30 - 70 triệu">Từ 30 - 70 triệu</option>
                <option value="Trên 70 triệu">Trên 70 triệu</option>
              </select>
            </div>
            <div class="form-group">
              <label for="status">Trạng thái:</label>
              <select class="form-control" name="status" id="status">
                <option value="0">New</option>
                <option value="1">Called</option>
                <option value="2">Success</option>
                <option value="3">False</option>
              </select>
            </div>
            <div class="form-group">
              <label for="note">Note:</label>
              <input type="text" class="form-control" id="note" name="note" maxlength="255">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>

    </div>
  </div>
@stop
