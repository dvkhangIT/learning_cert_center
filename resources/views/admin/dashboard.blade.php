@extends('layouts.master')
@section('name')
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-info">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Orders</p>
              <h4 class="my-1 text-info">4805</h4>
              <p class="mb-0 font-13">+2.5% from last week</p>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
              <i class='bx bxs-cart'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-danger">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Revenue</p>
              <h4 class="my-1 text-danger">$84,245</h4>
              <p class="mb-0 font-13">+5.4% from last week</p>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
              <i class='bx bxs-wallet'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-success">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Bounce Rate</p>
              <h4 class="my-1 text-success">34.6%</h4>
              <p class="mb-0 font-13">-4.5% from last week</p>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
              <i class='bx bxs-bar-chart-alt-2'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-warning">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Customers</p>
              <h4 class="my-1 text-warning">8.4K</h4>
              <p class="mb-0 font-13">+8.4% from last week</p>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
              <i class='bx bxs-group'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--end row-->

  <div class="row">
    <div class="col-12 col-lg-8 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Sales Overview</h6>
            </div>
            <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                data-bs-toggle="dropdown"><i
                  class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another
                    action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else
                    here</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
            <span class="border px-1 rounded cursor-pointer"><i
                class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
            <span class="border px-1 rounded cursor-pointer"><i
                class="bx bxs-circle me-1"
                style="color: #ffc107"></i>Visits</span>
          </div>
          <div class="chart-container-1">
            <canvas id="chart1" width="962" height="325"
              style="display: block; box-sizing: border-box; height: 260px; width: 769px;"></canvas>
          </div>
        </div>
        <div
          class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">24.15M</h5>
              <small class="mb-0">Overall Visitor <span> <i
                    class="bx bx-up-arrow-alt align-middle"></i>
                  2.43%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">12:38</h5>
              <small class="mb-0">Visitor Duration <span> <i
                    class="bx bx-up-arrow-alt align-middle"></i>
                  12.65%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">639.82</h5>
              <small class="mb-0">Pages/Visit <span> <i
                    class="bx bx-up-arrow-alt align-middle"></i>
                  5.62%</span></small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Trending Products</h6>
            </div>
            <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                data-bs-toggle="dropdown"><i
                  class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another
                    action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else
                    here</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-container-2">
            <canvas id="chart2" width="446" height="275"
              style="display: block; box-sizing: border-box; height: 220px; width: 356px;"></canvas>
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li
            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
            Jeans <span class="badge bg-success rounded-pill">25</span>
          </li>
          <li
            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
            T-Shirts <span class="badge bg-danger rounded-pill">10</span>
          </li>
          <li
            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
            Shoes <span class="badge bg-primary rounded-pill">65</span>
          </li>
          <li
            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
            Lingerie <span
              class="badge bg-warning text-dark rounded-pill">14</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
