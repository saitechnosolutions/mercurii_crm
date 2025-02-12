<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/images/" >
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    {{-- <script src="https://use.fontawesome.com/bcf6e17f6b.js"></script> --}}
    <title>Mercuri Storage Solutions</title>
    <style>
        .wrapper {
            width: auto;
            position: relative
        }

        .authentication-card {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            max-width: 50rem;
            height: 100vh;
        }

        .login-separater span {
            position: relative;
            top: 26px;
            margin-top: -10px;
            background: #fff;
            padding: 5px;
            font-size: 12px;
            color: #cbcbcb;
            z-index: 1;
        }

        .authentication-content {
            width: 750px;
            /* height: 500px; */
            /* position: absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%;) */
            margin: 0 auto;
            display: block;
        }

        .form-control:focus {
            border-color: #ccc;
            /* Replace with your desired color */
            box-shadow: 10px 10px 14px -12px rgba(0, 0, 0, 0.61);
        }
    </style>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper"
        style="background-image:url('/images/background.png');background-size:cover;background-repeat:no-repeat;">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow  overflow-hidden" style="border-radius:15px;">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center justify-content-center"
                                style="background-color:#ffffff;height:490px;">
                                {{-- <h4 style="color:#ffffff;">Mercury Storage Solutions</h4> --}}
                                <img src="assets/images/nea8.svg" class="img-fluid" alt="" style="max-width:105%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    {{-- <h6 style="text-align: center;">Mercury Storage Solutions</h6> --}}
                                    {{-- <img src="images/logo.png" class="img-fluid m-auto d-block" style="width:100px"> --}}
                                    {{-- <img src="images/logo1sts.png" class="img-fluid m-auto d-block"
                                        style="width:160px"> --}}
                                    <h5 class="mt-3 text-center" style="color:#ff6500;"><b>Welcome</b></h5>
                                    <p class="text-center" style="font-weight:bold;color:#1b5584;"><span style="color:#ff6500;">Login</span> Your Account</p>
                                    @if (session()->get('success'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session()->get('success') }}

                                        </div>
                                    @endif
                                    <form class="form-horizontal login-form" id="crm_login_form">
                                        @csrf
                                        <div class="login-separater text-center mb-4">
                                            {{-- <hr> --}}
                                        </div>
                                        <div class="row g-3" style="gap: 20px;">
                                            <div class="col-12">
                                                {{-- <label for="inputEmailAddress" class="form-label">Email Address</label> --}}
                                                <div class="ms-auto position-relative">
                                                    <div class="input-group mb-1">
                                                        <span style="border-left: 0px;border-right: 0px;border-top: 0px;border-color: #fc630a;border-radius:0px;" class="input-group-text bg-transparent"
                                                            id="basic-addon1"><img src="assets/images/b-2.png"
                                                                class="img-fluid"></span>
                                                        <input id="login_username" style="border-left: 0px;border-right: 0px;border-top: 0px;border-color: #fc630a;border-radius:0px;"
                                                            class="form-control" type="text"
                                                            placeholder="Registered Mobile number" required
                                                            name="username" value="+91-">
                                                    </div>
                                                    {{-- <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div> --}}
                                                    {{-- <input type="email" name="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address"> --}}
                                                    {{-- <input id="login_username" class="form-control  " style="border-radius:10px" type="text" placeholder="Enter Mobile Number" required name="username"> --}}
                                                    <span style="color:red" id="mobile-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                {{-- <label for="inputChoosePassword" class="form-label">Enter Password</label> --}}
                                                <div class="ms-auto position-relative">
                                                    <div class="input-group mb-4">
                                                        <span style="border-left: 0px;border-right: 0px;border-top: 0px;border-color: #fc630a;border-radius:0px;" class="input-group-text bg-transparent"
                                                            id="basic-addon1"><img src="assets/images/password.png"
                                                                class="img-fluid"></span>
                                                        <input id="login_password" style="border-left: 0px;border-right: 0px;border-top: 0px;border-color: #fc630a;border-radius:0px;"
                                                            class="form-control" type="password" name="password"
                                                            max="4" placeholder="Enter 4 digit PIN" required>
                                                        <br>

                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" onclick="passwordhideshow()"
                                                            type="checkbox" id="flexCheckChecked">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Show Password
                                                        </label>
                                                    </div>

                                                    {{-- <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div> --}}

                                                    <span style="color:red" id="password-error"></span>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button style="background: #1b5584;" type="button" name="signin" id="user_login_click"
                                                        class="btn btn-primary radius-30">Login</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://use.fontawesome.com/bcf6e17f6b.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

{{-- <body  style="background-image:url('/images/background.png');background-size:cover;background-repeat:no-repeat;">
	<div class="container d-flex justify-content-center">
        <div class="img-container">
            <img src="/images/uservector.png" class="img-fluid">
        </div>
		<div class="login-container-wrapper ">
			<div class="logo">
				<i class="fa fa-sign-in" style="color:#4286f6"></i>
			</div>
			<div class="welcome"><strong>Welcome,<br></strong>Lets Get Start Now!</div>
            @if (session()->get('success'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{session()->get('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                @endif
			<form class="form-horizontal login-form" id="crm_login_form">
                @csrf
				<div class="form-group relative">
					<input id="login_username" class="form-control input-lg" type="text" placeholder="Enter Mobile Number" required name="username">
					<i class="fa fa-user" style="color:#4286f6"></i>
				</div>
                <span style="color:red" id="mobile-error"></span>
				<div class="form-group relative password">
					<input id="login_password" class="form-control input-lg mt-3" type="password" name="password" max="4" placeholder="Enter 4 digit PIN" required>
					<i class="fa fa-lock" style="color:#4286f6"></i>
				</div>
                <span style="color:red" id="password-error"></span>
			  <div class="form-group">
			    <button type="button" id="user_login_click" class="btn btn-success btn-lg btn-block w-100 mt-3">Login</button>
			  </div>

			</form>
		</div>


	</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body> --}}

<script>
    $("#login_username").on("blur", function() {

        // var lettersRegex = /^[0-9]{14}$/;
        var lettersRegex = /^\+\d{1,3}-\d{10}$/;


        var mobilenum = $(this).val();

        var out = lettersRegex.test(mobilenum);

        if (mobilenum.length != 0) {
            if (out == false) {
                $("#mobile-error").text("Enter Country code with 10 digit numbers only");
                $(this).focus();
            } else {
                $("#mobile-error").text("");
            }
        } else {
            $("#mobile-error").text("");
        }
    });


    $("#login_password").on("blur", function() {

        var lettersRegex = /^[0-9]{4}$/;

        var password = $(this).val();

        var out = lettersRegex.test(password);

        if (password.length != 0) {
            if (out == false) {
                $("#password-error").text("Enter 4 digit numbers only");
                $(this).focus();
            } else {
                $("#password-error").text("");
            }
        } else {
            $("#password-error").text("");
        }
    });

    function passwordhideshow() {
        var x = document.getElementById("login_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    // $(document).ready(function() {
    //     $(document).on("click", "#user_login_click", function() {

    //         var formData = $("#crm_login_form").serialize();

    //         $.ajaxSetup({
    //             headers: {
    //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
    //                     "content"
    //                 ),
    //             },
    //         });
    //         $.ajax({
    //             url: "/login",
    //             method: "POST",
    //             data: formData,
    //             success: function(response) {
    //                 if (response.status === 200) {
    //                     swal.fire(
    //                         "Success",
    //                         "Logged in Succesfully",
    //                         "success"
    //                     );

    //                     const Toast = Swal.mixin({
    //                         toast: true,
    //                         position: "top-end",
    //                         showConfirmButton: false,
    //                         timer: 1500,
    //                         timerProgressBar: true,
    //                         didOpen: (toast) => {
    //                             toast.onmouseenter = Swal.stopTimer;
    //                             toast.onmouseleave = Swal.resumeTimer;
    //                         },
    //                     });

    //                     Toast.fire({
    //                         icon: "success",
    //                         title: "Logged in Succesfully",
    //                     });

    //                     setTimeout(function() {
    //                         window.location.reload();
    //                     }, 1500);
    //                 } else {
    //                     Swal.fire("Error!", "Log in failed", "Error");
    //                 }

    //             },
    //             error: function(data) {
    //                 Swal.fire("Error!", "Log in failed", "Error");

    //                 const Toast = Swal.mixin({
    //                     toast: true,
    //                     position: "top-end",
    //                     showConfirmButton: false,
    //                     timer: 1500,
    //                     timerProgressBar: true,
    //                     didOpen: (toast) => {
    //                         toast.onmouseenter = Swal.stopTimer;
    //                         toast.onmouseleave = Swal.resumeTimer;
    //                     },
    //                 });

    //                 Toast.fire({
    //                     icon: "Error",
    //                     title: "Log in failed",
    //                 });

    //                 setTimeout(function() {
    //                     window.location.reload();
    //                 }, 1500);
    //             },
    //         });
    //     });
    // });
     $(document).ready(function() {
        $(document).on("click", "#user_login_click", function() {

            var formData = $("#crm_login_form").serialize();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "/login",
                method: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire(
                            "Success",
                            response[
                                0], // Use the actual message returned from the server
                            "success"
                        );

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });

                        Toast.fire({
                            icon: "success",
                            title: response[
                                0
                            ], // Use the actual message returned from the server
                        });

                        setTimeout(function() {
                            window.location.href='/dashboard';
                        }, 1500);
                    } else {
                        Swal.fire("Error!", response[0],
                            "error"); // Use response[0] for error message

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });

                        Toast.fire({
                            icon: "error",
                            title: response[
                                0
                            ], // Use the actual message returned from the server
                        });

                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }

                },
                error: function(data) {
                    Swal.fire("Error!", "Log in failed", "error");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                    });

                    Toast.fire({
                        icon: "error", // Use "error" instead of "Error" for icon
                        title: "Log in failed",
                    });

                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                },
            });
        });
    });
</script>

</html>
