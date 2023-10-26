<!DOCTYPE html>
<html>

<head>
    <title>Certificate of Completion</title>


    <style>
        @font-face {
            font-family: Poppins;
            src: url({{ storage_path('fonts/Poppins-Medium.ttf') }}) format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: Rakkas;
            src: url({{ storage_path('fonts/Rakkas-Regular.ttf')}}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }

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
            font-family: Rakkas;
        }

        .main-wrapper {
            width: 100%;
            height: 100vh;
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
            left: 45%;
            top: 45%;
            z-index: 9999;
            transform: translate(-45%, -45%);
        }

        .name-box h1 {
            color: #047580;
            text-align: center;
            font-size: 2rem;
            font-style: normal;
            line-height: normal;
            letter-spacing: 0.29rem;
            font-weight: 400;
            text-transform: uppercase;
            font-family: Rakkas;
        }

        .course-name {
            position: absolute;
            left: 49%;
            top: 54%;
            z-index: 9999; 
        }

        .course-name h4 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1.125rem;
            font-style: normal;
            line-height: 110%; 
            font-family: Rakkas;
            font-weight: 400;
            text-align: left;
        }

        .course-date {
            position: absolute;
            left: 42%;
            top: 63%;
            z-index: 9999;
            transform: translate(-42%, -63%);
        }

        .course-date h4 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1.125rem;
            font-style: normal;
            line-height: 150%; 
            font-weight: 400;
            font-family: Rakkas;
        }

        .signature {
            position: absolute;
            left: 15%;
            bottom: 16%;
            z-index: 9999;
        }

        .signature img {
            max-width: 6.375rem;
            mix-blend-mode: darken;
        }

        .date-bottom {
            position: absolute;
            right: 24%;
            bottom: 16%;
            z-index: 9999;
        }

        .date-bottom h6 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            text-align: center;
            font-family: Poppins;
            font-size: 1rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            letter-spacing: 0.02rem;
        }

        @page {
            size: 8.7in 6in;
        }
    </style>
</head>

<body>

    <!-- main are -->

    <div class="main-wrapper">
        <div class="container">
            <div class="certificate-box">
                <img src="{{ public_path('latest/assets/images/certificate/one.png') }}" alt="Certificate-bg"
                    class="img-fluid main-certificate">

                <div class="name-box">
                    <h1>{{ $fullName }}</h1>
                </div>
                <div class="course-name">
                    <h4>{{$course->title}} </h4>
                </div>
                <div class="course-date">
                    <h4>{{ date('d M Y', strtotime($courseCompletionDate)) }}
                    </h4>
                </div>

                <div class="signature">
                    <img src="{{ public_path($signature) }}" alt="Signature" class="img-fluid">
                </div>

                <div class="date-bottom">
                    <h6>{{ date('d M Y', strtotime($courseIssueDate)) }}</h6>
                </div>
            </div>
        </div>
    </div>

</body>

</html>