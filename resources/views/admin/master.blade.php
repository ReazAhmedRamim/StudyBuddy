<!doctype html>
<html lang="en">

<head>
    @include('section.link')
    <title>StudyBuddy-admin dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('admin.sidebar')

        <!--start header -->
        @include('admin.header')

        <!--start page wrapper -->
        <div class="page-wrapper">

            @yield('content')

        </div>
        <!--end page wrapper -->


       @include('section.footer')



    </div>
    <!--end wrapper-->


    <!-- Bootstrap JS -->
    @include('section.script')

</body>

</html>
