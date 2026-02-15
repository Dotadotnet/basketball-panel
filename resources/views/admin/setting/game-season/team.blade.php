@extends('layout.admin_template')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <!-- عنوان -->
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <div>
                        <h5 class="fw-bold mb-1">
                            فصل مسابقاتی: {{ $info->name }}
                        </h5>
                        <small class="text-muted">
                            دسته: {{ $info->category_name }}
                        </small>
                    </div>

                    @if ($info->status == 'notStarted')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-warning"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-warning">
                                شروع نشده
                            </span>
                        </span>
                    @elseif($info->status == 'done')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-secondary"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-secondary">
                                پایان یافته
                            </span>
                        </span>
                    @elseif($info->status == 'doing')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-success"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-success">
                                در حال برگزاری
                            </span>
                        </span>
                    @endif
                </div>

                <hr class="my-4">

                <!-- اطلاعات -->
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">تاریخ برگزاری</small>
                            <span class="fw-semibold">{{ $info->date }}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">زمان شروع</small>
                            <span class="fw-semibold">
                                {{ $info->start_time_at }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">زمان پایان</small>
                            <span class="fw-semibold">
                                {{ $info->finish_time_at ?? 'هنوز ثبت نشده' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">جنسیت</small>
                            <span class="fw-semibold">
                                {{ $info->gender == 'women' ? 'دختران' : 'پسران' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">شناسه فصل</small>
                            <span class="fw-semibold">
                                #{{ $info->id }}
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">
                            تیم‌های شرکت‌کننده
                        </h5>
                        <small class="text-muted" id="teamCountInfo"></small>
                    </div>

                    <span class="badge bg-primary rounded-pill" id="teamCountBadge"></span>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="teamSearch" class="form-control"
                            placeholder="جستجو بر اساس نام یا آیدی تیم">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>شناسه تیم</th>
                                <th>نام تیم</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="teamsBody"></tbody>
                    </table>
                </div>

                <nav dir="ltr">
                    <ul class="pagination justify-content-center mt-4" id="pagination"></ul>
                </nav>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/sweetalert_2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>
        const teamsData = @json($teams);

        document.addEventListener("DOMContentLoaded", function() {

            const rowsPerPage = 10;
            let currentPage = 1;
            let filteredTeams = [...teamsData];
const currentUrl = window.location.href;

            const tbody = document.getElementById("teamsBody");
            const pagination = document.getElementById("pagination");
            const searchInput = document.getElementById("teamSearch");
            const teamCountBadge = document.getElementById("teamCountBadge");
            const teamCountInfo = document.getElementById("teamCountInfo");

            function renderTable() {
                tbody.innerHTML = "";

                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const pageItems = filteredTeams.slice(start, end);

                if (pageItems.length === 0) {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        تیمی یافت نشد
                    </td>
                </tr>
            `;
                } else {
                    pageItems.forEach((team, index) => {
                        const tr = document.createElement("tr");

                        tr.innerHTML = `
                    <td>${start + index + 1}</td>
                    <td><span class="badge bg-secondary">${team.id}</span></td>
                    <td class="fw-semibold">${team.name}</td>
                    <td class="fw-semibold"> <a class="text-primary" href="${currentUrl + "/" +team.id}">  اطلاعات بیشتر  </a></td>
                `;

                        tbody.appendChild(tr);
                    });
                }

                updateCounts();
                renderPagination();
            }

            function updateCounts() {
                teamCountBadge.textContent = teamsData.length + " تیم";
                teamCountInfo.textContent =
                    "نمایش " + filteredTeams.length +
                    " از " + teamsData.length + " تیم";
            }

            function renderPagination() {
                pagination.innerHTML = "";
                const pageCount = Math.ceil(filteredTeams.length / rowsPerPage);

                for (let i = 1; i <= pageCount; i++) {
                    const li = document.createElement("li");
                    li.className = "page-item " + (i === currentPage ? "active" : "");

                    const a = document.createElement("a");
                    a.className = "page-link";
                    a.href = "#";
                    a.textContent = i;

                    a.addEventListener("click", function(e) {
                        e.preventDefault();
                        currentPage = i;
                        renderTable();
                    });

                    li.appendChild(a);
                    pagination.appendChild(li);
                }
            }

            searchInput.addEventListener("keyup", function() {
                const value = this.value.toLowerCase();

                filteredTeams = teamsData.filter(team =>
                    team.name.toLowerCase().includes(value) ||
                    team.id.toString().includes(value)
                );

                currentPage = 1;
                renderTable();
            });

            renderTable();
        });
    </script>
@endsection
