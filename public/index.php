<!DOCTYPE HTML>
<html>
<head>
    <title>Amazon S3 / Cloudsearch demo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/main.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <?php if(isset($color)) {?>
    <div class="alert alert-<?php echo $color ?>" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $msg?>
    </div>
    <?php } ?>

    <div class="starter-template">
        <h1>Amazon S3 / Cloudsearch demo</h1>
        <p class="lead">Put a twitter handle below, the last 100 tweets/retweets will be indexed by Cloudsearch and be searchable.</p>
    </div>

    <div>

        <form action="twitter.php" method="post" class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="twitter_handle">twitter handle</label>

                <div class="input-group input-group-lg">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" id="twitter_handle" name="twitter_handle"
                           placeholder="Twitter Handle">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Add</button>
        </form>

    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
</body>

</html>