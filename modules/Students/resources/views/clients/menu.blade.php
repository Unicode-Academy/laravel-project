<ul style="border: 0;" class="nav nav-pills flex-column">
    <li class="nav-item"><a class="nav-link {{activeMenu('students.account.index') ? 'active': ''}}" href="{{route('students.account.index')}}">Tổng quan</a></li>
    <li class="nav-item"><a class="nav-link {{activeMenu('students.account.profile') ? 'active': ''}}" href="{{route('students.account.profile')}}">Thông tin</a></li>
    <li class="nav-item"><a class="nav-link {{activeMenu('students.account.courses') ? 'active': ''}}" href="{{route('students.account.courses')}}">Khóa học của tôi</a></li>
    <li class="nav-item"><a class="nav-link {{activeMenu('students.account.orders') ? 'active': ''}}" href="{{route('students.account.orders')}}">Đơn hàng</a></li>
    <li class="nav-item"><a class="nav-link {{activeMenu('students.account.password') ? 'active': ''}}" href="{{route('students.account.password')}}">Đổi mật khẩu</a></li>
    <li class="nav-item"><a class="nav-link" href="#" onclick="document['form-logout'].submit(); return false;">Đăng xuất</a></li>
</ul>