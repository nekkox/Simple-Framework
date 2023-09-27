<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>HOME PAGE</h1>
<hr>
<br>

<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt"/>
    <button type="submit">Upload</button>
</form>

<div>

    <?php if (empty($invoice)) {
        echo '<h2>' . $noInvoice . '</h2>';
    } else {
        echo '<hr>'.
            'INVOICE ID:'.$invoice['invoice_id'] . '<br />' .
            'INVOICE AMOUNT:' . $invoice['amount'] . '<br />' .
            'USER:' . $invoice['name'] . '<br />';
    }
    ?>

</div>
<?php
//var_dump($this->params);
//echo ($this->params['foo']);
//echo $this->foo;
//echo $foo;
?>

</body>
</html>