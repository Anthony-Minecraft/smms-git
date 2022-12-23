<form id="myForm" action="../../source/php/mail.php" method="post">
    <input type="hidden" name="redirect" value="true">
    <input type="hidden" name="redirect_link" value="../../myriware/home/profile.php">
    <input type="hidden" name="to" value="<?php echo $_GET['email'] ?>">
    <input type="hidden" name="subject" value="Welcome to Myriware">
    <input type="hidden" name="content" value="Dear New User,\nWelcome to Myriware! This simple mesage is to ensure that your email address provided works. If you think this is a mistake, then please let us know.">
</form>
<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>