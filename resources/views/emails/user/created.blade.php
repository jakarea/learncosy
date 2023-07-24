<!DOCTYPE html>
<html>
<<<<<<< HEAD

=======
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Learncosy</title>
    <style>
        /* Reset styles */
<<<<<<< HEAD
        body,
        body * {
=======
        body, body * {
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .main-table {
            max-width: 800px;
            width: 100%;
<<<<<<< HEAD
            margin: 0 auto;
            text-align: left;
        }

        .main-table tr .header-table {
=======
            margin: 0 auto; 
            text-align: left;
        } 
          .main-table tr .header-table {
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
            text-align: center;
            padding: 1rem;
            width: 100%;
            background-color: #5a4b4b;
<<<<<<< HEAD
            /* primary_color variable */
        }

        .main-table tr th h1 {
            font-size: 2rem;
            font-weight: 700;
            padding-left: 1rem;
            padding-right: 1rem;
            color: #fff
        }

        .main-table tr th a {
            display: block;
            margin-top: .3rem;
        }

        .main-table tr th img {
            width: 8rem;
            display: block;
        }

        .main-table tr th p {
            font-size: 0.9rem;
            font-weight: 400;
            color: #fff;
        }

        .body-table {
            width: 100%;
            padding: 2rem;
            background-color: #fff;
        }

        .body-table h4 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .body-table h5 {
            margin-top: 1rem;
            font-size: .9rem;
        }

        .body-table h5 span {
            font-weight: 500;
            color: green;
        }

        .body-table h4 span {
            font-size: 1.1rem;
            font-weight: 400;
        }

        .project-ftr {
            background-color: #ddd;
            padding: 1rem;
            text-align: center;
        }

        .project-ftr p {
            font-size: .9rem;
        }

        @media (min-width: 320px) and (max-width: 767px) {
            .main-table tr th h1 {
                font-size: 1.2rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .main-table tr th h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

=======
          }
          .main-table tr th h1{
            font-size: 2rem;
            font-weight: 700; 
            padding-left: 1rem;
            padding-right: 1rem;
            color: #fff
          }

          .main-table tr th a{
            display: block;
            margin-top: .3rem;
          }
          .main-table tr th img{
            width: 8rem; 
            display: block;
          }
          .main-table tr th p{
            font-size: 0.9rem;
            font-weight: 400;
            color: #fff;
          }
          .body-table{
            width: 100%;
            padding: 2rem;
            background-color: #fff;
          }

          .body-table h4{
            margin-bottom: 1rem;
            font-size: 1.2rem;
          }
          .body-table h5{
            margin-top: 1rem;
            font-size: .9rem;
          }

          .body-table h5 span{ 
            font-weight: 500;
            color: green;
          }

          .body-table h4 span{
            font-size: 1.1rem;
            font-weight: 400;
          }
          .project-ftr{
            background-color: #ddd;
            padding: 1rem;
            text-align: center;
          }
          .project-ftr p{
            font-size: .9rem;
          }

          @media (min-width: 320px) and (max-width: 767px) {
            .main-table tr th h1{
                font-size: 1.2rem; 
            }
          }

          @media (min-width: 768px) and (max-width: 991px) {
            .main-table tr th h1{
                font-size: 1.8rem; 
            }
          }
    </style>
</head>
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
<body>

    <table cellpadding="0" cellspacing="0" border="0" class="main-table">
        <tr>
            <th>
                <table cellpadding="0" cellspacing="0" border="0" class="header-table">
                    <tr>
                        <th>
                            <a href="https://app.learncosy.com">
<<<<<<< HEAD
                                <img src="https://app.learncosy.com/assets/images/learncosy-logo.png" alt="learncosy">
=======
                                <img src="https://app.learncosy.com/assets/images/learncosy-logo.png" alt="learncosy"> 
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
                            </a>
                        </th>
                        <th>
                            <h1>Welcomr Mr. {{ $user->name }}</h1>
                        </th>
                        <th>
                            <p>{{$user->created_at->diffForHumans()}}</p>
                        </th>
                    </tr>
                </table>
            </th>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" class="body-table">
                    <tr>
                        <td>
<<<<<<< HEAD
                            <h4><span>Welcome to Learncosy! We're so excited to have you on board.We know you're
                                    probably eager to get started, so we've put together this quick welcome email to
                                    help you get up and running.</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4><span>First, here are a few instructions on how to use the platform:</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>
                                <span>To log in, simply go to <a href="https://app.learncosy.com/login">Learncosy Login</a> and enter your email address and password.</span>
                            </h4>
                            <h4>
                                <span>
                                    Once you're logged in, you will be able to acess some of your features, to get access all of your features you have to do some things: 
                                </span>
                            </h4>

                            <h4>
                                <span>
                                    1. Update Profile Information
                                </span>
                            </h4>
                            <h4>
                                <span>
                                    2. Enroll to a course
                                </span>
                            </h4>
                            <h4>
                                <span>
                                    3. Complete Your Payment
                                </span>
                            </h4> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Some of our features:</h3>
                            <ul>
                                <li>Easy to enroll to a course</li> 
                                <li>Very fast Payment options</li> 
                                <li>Very fast Payment options</li> 
                                <li>Our Learncosy Instructor is a great place to learn more about our course and how to get it in.</li>
                                <li></li>
                                
=======
                            <h4><span>Thank you for joining Learncosy. We're excited to have you as a new member.Here are some important details and instructions for getting started:</span></h4>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <h3>Account Information:</h3> 
                            <ul>
                                <li><strong>Email:</strong> {{ $user->email }}</li> 
                                <li><strong>Phone:</strong> {{ $user->phone }}</li> 
                                <li><strong>Registered as:</strong> {{ $user->user_role }}</li> 
                                {{-- <li><strong>Primary Color:</strong> <span class="p-2" class="{{ modulesetting('primary_color') }};"></span> </li>   
                                <li><strong>Secondary Color:</strong> <span class="p-2" class="{{ modulesetting('primary_color') }};"></span> </li>    --}}
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
<<<<<<< HEAD
                            <p style="margin-top: 1rem">Thank you again for <strong>Registered as:</strong> {{ $user->user_role }} with Learncosy. We hope you have a great experience!</p>
=======
                            <p style="margin-top: 1rem">Thank you again for choosing Learncosy. We hope you have a great experience!</p>
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <h5>Joined at: {{$user->created_at}}</h5>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="project-ftr">
<<<<<<< HEAD
                <p> This email is personalized with clear instructions on how to use the platform, as well as a brief overview of the key features and useful resources.</p>
                <p>This is an automated email, please do not reply.</p>
            </td>
        </tr>
    </table>
</body>

=======
                <p>This is an automated email, please do not reply.</p>
            </td>
        </tr>
    </table> 
</body>
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
</html>