<!DOCTYPE html>
<html>

<head>
    <title>Certificate of Completion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Rakkas&display=swap" rel="stylesheet">

    <style> 
        * {
            padding: 0;
            margin: 0;
            outline: none;
            list-style-type: none;
            text-decoration: none;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;  
            font-family: 'Rakkas', serif;
        }

        .main-wrapper {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 832px;
            height: 6in;
            margin: 0 auto;
        }

        .certificate-box {
            width: 832px;
            height: 6in;
            position: relative;
        }

        .certificate-box img.main-certificate {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .name-box {
            position: absolute;
            left: 0%;
            top: 43%;
            z-index: 9999;
            width: 100%;
            text-align: center;
        }

        .name-box h1 {
            color: #4F8AC0;
            text-align: center;
            font-size: 2rem;
            font-style: normal;
            line-height: normal; 
            font-weight: 400;
            text-transform: uppercase; 
        }

        .course-name {
            position: absolute;
            left: 54%;
            top: 56%;
            z-index: 9999; 
        }

        .course-name h4 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1rem;
            font-style: normal;
            line-height: 110%;  
            font-weight: 400;
            text-align: left;
        }

        .course-date {
            position: absolute;
            left: 38.5%;
            top: 60%;
            z-index: 9999; 
        }

        .course-date h4 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1rem;
            font-style: normal;
            line-height: 120%; 
            font-weight: 400; 
        }

        .signature {
            position: absolute;
            left: 17%;
            bottom: 20%;
            z-index: 9999;
        }

        .signature img {
            max-width: 6.375rem;
            mix-blend-mode: darken;
        }

        .date-bottom {
            position: absolute;
            right: 18%;
            bottom: 20%;
            z-index: 9999;
        }

        .date-bottom h6 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            letter-spacing: 0.02rem;
        } 
    </style>
</head>

<body>

    <!-- main are -->

    <div class="main-wrapper">
        <div class="container">
            <div class="certificate-box">
                <img src="{{ asset('latest/assets/images/certificate/three.png') }}" alt="Certificate-bg"
                    class="img-fluid main-certificate">

                <div class="name-box">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>
                <div class="course-name">
                    <h4>{{$course->title}} </h4>
                </div>
                <div class="course-date">
                    <h4>{{ date('d M Y', strtotime($courseDate)) }}
                    </h4>
                </div>

                <div class="signature">
                    <img src="{{ asset($signature) }}" alt="Signature"
                        class="img-fluid">
                </div>

                <div class="date-bottom">
                    <h6>{{ date('d M Y') }}</h6>
                </div>
            </div>
        </div>
    </div>

</body>

</html>