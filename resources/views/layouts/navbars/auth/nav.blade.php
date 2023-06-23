<nav class="navbar navbar-main navbar-expand-lg p-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
      </ol>
      <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar"> 
      <ul class="navbar-nav justify-content-end">
        @can ('unitadmin')
        <li class="nav-item d-flex align-items-center px-3">
          <a href="" class="nav-link text-body p-0">
            <i class="fas fa-building me-sm-1"></i>
            <span class="text-sm d-none d-lg-inline-block">{{ Auth::user()->unit->name }}</span>
          </a>
        </li>
        @endcan
        <li class="nav-item d-flex align-items-center px-3">
          <a href="" class="nav-link text-body p-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none px-3 font-weight-bold">{{ Auth::user()->name }}</span>
            <span class="d-sm-inline d-none text-muted">({{ Auth::user()->role }})</span>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center">
          <form class="mb-0" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link text-body font-weight-bold px-0 py-0" style="border: none; background: none;">
              <i class="fa fa-sign-out-alt ms-sm-1"></i>    
              <span class="d-sm-inline d-none">Keluar</span>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
