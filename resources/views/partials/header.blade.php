<header class="top-header">
    <nav class="navbar navbar-expand">
       <div class="mobile-toggle-icon d-xl-none">
          <i class="bi bi-list"></i>
       </div>
       <div class="top-navbar d-none d-xl-block">
          <ul class="navbar-nav align-items-center">
             <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">{{date('d M, Y : D')}}</a>
             </li>
          </ul>
       </div>
       <div class="top-navbar-right d-xl-flex ms-auto">
          <ul class="navbar-nav align-items-center">
             <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                   <div class="user-setting d-flex align-items-center gap-1">
                      <img src="{{showDefaultImage('storage/'.auth()->user()->avatar)}}" class="user-img" alt="">
                      <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
                   </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                            <img src="{{asset('images/avatars/avatar-1.png')}}" alt="" class="rounded-circle" width="60" height="60">
                            <div class="ms-3">
                               <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                               <small class="mb-0 dropdown-user-designation text-secondary">Admin</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li>
                      <hr class="dropdown-divider">
                   </li>
                   <li>
                      <a class="dropdown-item" href="{{ route('profile-settings') }}">
                         <div class="d-flex align-items-center">
                            <div class="setting-icon"><i class="lni lni-cog"></i></div>
                            <div class="setting-text ms-3"><span>Profile Settings</span></div>
                         </div>
                      </a>
                   </li>
                   <li>
                      <hr class="dropdown-divider">
                   </li>
                   <li>
                      <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-flex align-items-center">
                            <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                            <div class="setting-text ms-3"><span>Logout</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                      </a>
                   </li>
                </ul>
             </li>
          </ul>
       </div>
    </nav>
 </header>