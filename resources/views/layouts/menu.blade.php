<!-- need to remove -->
    <li class="nav-item">
    <a href="/home" class="nav-link">
    <!-- <a href="#" class="nav-link active"> -->
      <i class="fas fa-tachometer-alt"  aria-hidden="true" style="font-size:1.6em;margin-right:10px;"></i>
      <p>
        Dashboard
        <!-- panah dropdown <i class="right fas fa-angle-left"></i> -->
      </p>
    </a>
  </li>
  
  <!-- Menu Sparepart -->
  <li class="nav-item">
    <a href="{{ route('materi.index') }}" class="nav-link">
    <!-- <a href="#" class="nav-link active"> -->
      <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:1.6em;margin-right:10px;"></i>
      <p>Lihat Materi
        <!-- panah dropdown <i class="right fas fa-angle-left"></i> -->
      </p>
    </a>
  </li>


    <!-- menu admin -->  
  <li class="nav-item">
    <a href="#" class="nav-link">
    <!-- <a href="#" class="nav-link active"> -->
      <i class="nav-icon fa fa-users" aria-hidden="true"  style="font-size:1.6em;margin-right:10px;"></i>
      <p>
        Admin
        <i class="right fas fa-angle-left"></i>
        <!-- panah dropdown <i class="right fas fa-angle-left"></i> -->
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">
          <div style="width:10%;float:left;margin-left:20px;margin-right:5px">
            <i class="fa fa-user"></i>
          </div>
          <p>User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('content.index') }}" class="nav-link">
          <div style="width:10%;float:left;margin-left:20px;margin-right:5px">
            <i class="fas fa-file-video"></i>
          </div>
          <p>Manajemen Video</p>
        </a>
      </li>
    </ul>
  </li>
