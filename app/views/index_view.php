<form action="/router/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt" />
    <button type="submit">Upload</button>
</form>

<?php
echo ($this->params['foo']);
echo '<br>';
echo $this->foo;
echo '<br>';
echo $foo;
?>