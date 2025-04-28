<!doctype html>
<html lang="en">

<head>
    @include('section.link')
    <title>StudyBuddy-Student dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('student.sidebar')

        <!--start header -->
        @include('student.header')

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
