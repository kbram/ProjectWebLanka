<x-app-layout>
    <x-slot name="header">

        <div class="row">
            <h2 class="col font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <div class="col d-flex justify-content-end "><a href="/dashboard/user/add" type="button"
                    class="btn btn-success pull-right btn-sm"style="background-color:green;"><i class="fa fa-plus pr-2"
                        aria-hidden="true"></i> User</a></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" pt-0 mt-0">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <nav class="navbar mt-3  dark:bg-gray-800">
                    <a class="navbar-brand text-white"><b>Users Details</b></a>
                    <div class="form-inline">
                        <input class="form-control mr-sm-2" type="search" aria-label="Search" id="search" onchange="ajaxfunction()" 
                            placeholder="user@user.com">
                        <button class="btn btn-outline-light my-2 my-sm-0" id="searchButton">Search</button>
                    </div>
                </nav>
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped  dark:bg-gray-800 text-white">
                        <thead class=" bg-gray-100 dark:bg-gray-900">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact No</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="userBody">
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>{{ $user->contact_number }}</th>
                                    <th>{{ $user->home_address }}</th>
                                    <th>

                                        <a href="#" class="btn btn-danger btn-circle btn-sm mr-3"
                                            data-toggle="modal" data-target={{ '#deleteUser' . $user->id }}>
                                            <i class="fa fa-trash "></i>

                                        </a>
                                        <div class="modal fade text-dark" id={{ 'deleteUser' . $user->id }}
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?
                                                        </h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pt-4 pb-4">Click Delete below if
                                                        {{ $user->name }}'s
                                                        data will be deleted.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary"
                                                            style="background-color:#6c757d" type="button"
                                                            data-dismiss="modal">Cancel</button>
                                                        <span class="btn btn-danger btn-deleteUser" data-dismiss="modal"
                                                            id="{{ $user->id }}">Delete</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="dashboard/users/{{ $user->id }}/edit"
                                            class="btn btn-warning btn-circle btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".btn-deleteUser", function() {

            const $id = this.id;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                type: "POST",
                url: "/user/delete/" + $id,
                data: {
                    _token: CSRF_TOKEN,
                    id: $id
                },
                success: function(result) {
                    swal("Deleted", "Your imaginary user data has been deleted!", "success").then((
                        result) => {
                        location.reload();
                    });
                },
                error: function(response, status, error) {
                    if (response.status === 422) {}
                }
            });
        });

        $("#search").on("input", function() {
            filterData();
        });
        $(document).on("click", "#searchButton", function() {
            filterData();
        });
        function filterData(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            var email = $('#search').val();
            if(email===""){
                email=null;
            }
            $.ajax({
                type: "POST",
                url: "/users/filter/" + email,
                data: {
                    _token: CSRF_TOKEN,
                    email: email
                },
                success: function(response) {
                    $body = "";
                    console.log(response);
                    response.forEach((element, index) => {
                        $body += `<tr>
                                    <th scope="row">` + element.id + `</th>
                                    <th>` + element.name + `</th>
                                    <th>` + element.email + `</th>
                                    <th>` + element.home_address + `</th>
                                    <th>

                                        <a href="#" class="btn btn-danger btn-circle btn-sm mr-3"
                                            data-toggle="modal" data-target=#deleteUser` + element.id + `>
                                            <i class="fa fa-trash "></i>

                                        </a>
                                        <div class="modal fade text-dark" id=deleteUser` + element.id + `
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?
                                                        </h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pt-4 pb-4">Click Delete below if
                                                        ` + element.name + `'s
                                                        data will be deleted.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary"
                                                            style="background-color:#6c757d" type="button"
                                                            data-dismiss="modal">Cancel</button>
                                                        <span class="btn btn-danger btn-deleteUser" data-dismiss="modal"
                                                            id="` + element.id + `">Delete</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="dashboard/users/` + element.id + `/edit"
                                            class="btn btn-warning btn-circle btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </th>
                                </tr>`;

                    });
                    console.log($body);
                    $('#userBody').html($body);


                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
</x-app-layout>
