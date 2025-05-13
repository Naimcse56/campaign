<aside class="sidebar-wrapper">
    <div class="iconmenu">
       <div class="nav-toggle-box">
          <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
       </div>
       <ul class="nav nav-pills flex-column">
          <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
             <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-dashboards" type="button"><i class="lni lni-dashboard"></i></button>
          </li>
          <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Campaign">
             <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Campaign" type="button"><i class="lni lni-layers"></i></button>
          </li>
          <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Store">
             <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Store" type="button"><i class="lni lni-users"></i></button>
          </li>
          <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Reports">
             <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Reports" type="button"><i class="lni lni-users"></i></button>
          </li>
       </ul>
    </div>
    <div class="textmenu">
       <div class="brand-logo">
          <img src="{{asset('images/brand-logo-2.png')}}" width="140" alt=""/>
       </div>
       <div class="tab-content">
          <div class="tab-pane fade active show" id="pills-dashboards">
             <div class="list-group list-group-flush">
                <div class="list-group-item">
                   <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Dashboards</h5>
                   </div>
                </div>
                <a href="{{route('dashboard')}}" class="list-group-item"><i class="lni lni-dashboard"></i>Summary</a>
             </div>
          </div>
          <div class="tab-pane fade {{Route::is('*')  ? 'active show' : ''}}" id="pills-Campaign">
             <div class="list-group list-group-flush">
                <div class="list-group-item">
                   <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Campaign</h5>
                   </div>
                </div>
                <a href="#" class="list-group-item"><i class="lni lni-arrow-right"></i>Campaign</a>
             </div>
          </div>
          <div class="tab-pane fade {{Route::is('*')  ? 'active show' : ''}}" id="pills-Store">
             <div class="list-group list-group-flush">
                <div class="list-group-item">
                   <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Store</h5>
                   </div>
                </div>
                <a href="{{route('shop.index')}}" class="list-group-item"><i class="lni lni-arrow-right"></i>Store</a>
             </div>
          </div>
       </div>
    </div>
 </aside>