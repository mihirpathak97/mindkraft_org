<!DOCTYPE html>
  <html lang="en-US">

    <head>
      <meta charset="utf-8">
    </head>

    <link href='https://fonts.googleapis.com/css?family=Raleway|Roboto' rel='stylesheet' type='text/css'>

    <body style="overflow:hidden">

        <h2 style="font-weight: 400;color: #000;font-size: 2rem;text-align: center;font-family: 'Roboto', sans-serif; margin-top: 5rem;" >Your verification link is : <a style="text-decoration: none;" href="<?php echo 'http://18.216.69.81/verify/'. $id . '/' . hash('sha256', $id) . '/' . $api_token; ?>"><span style="font-weight: bold;color: rgba(0, 0, 0, 0.7);">Click here to verify</span></a> </h2><br><br>
        <p style="text-align: left;color: #000;position: relative;left: 7rem;font-family: 'Raleway', sans-serif;">With Regards,</p>
        <p style="text-align: left;color: #000;position: relative;left: 7rem;font-family: 'Raleway', sans-serif;">MindKraft Tech Team</p>

    </body>

</html>
