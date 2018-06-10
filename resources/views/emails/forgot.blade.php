<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forgot Password</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000000;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #000000;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .d{
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                
                <form action="https://api.dikodingin.com/client/change-password" method="post">
                    
                    <table>
                        <tr>
                            <td><label for="">Password</label></td>
                            <td>:</td>
                            <td><input type="password" name="password" placeholder="Password Baru"></td>
                        </tr>

                        <tr class="d">
                            <td><label for="">Konfirmasi Password</label></td>
                            <td>:</td>
                            <td><input type="password" name="conf_password" placeholder="Konfirmasi Password"></td>
                        </tr>

                        <tr class="d">
                            <td><label for="">Konfirmasi Email</label></td>
                            <td>:</td>
                            <td><input type="email" name="email" placeholder="Konfirmasi Email"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><input type="submit" value="Update"></td>
                        </tr>
                    </table>
                </form>

                
            </div>
        </div>
    </body>
</html>
