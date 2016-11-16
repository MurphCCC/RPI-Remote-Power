
<style>

button.power_on {
    background-color: lime;
    width: 200px;
    height: 100px;
    border: 1px solid white;
    border-radius: 10px;
    font-size: 5em;
    text-align: center;
    color: white;
}

button.power_off {
    background-color: red;
    width: 200px;
    height: 100px;
    border: 1px solid white;
    border-radius: 10px;
    font-size: 5em;
    text-align: center;
    color: white;
}
</style>

<?php
$on = $_GET[on];
$off = $_GET[off];
$pin_status = shell_exec("/usr/bin/gpio readall | grep 16 | awk '{print $17}' | sed '/|/d'");

echo "Welcome to our PowerSwitch Tail II API";

echo '<br />';
echo '<br />';
echo '<br />';

echo 'The current status of our PowerSwitch relay is:';

echo '<br />';
echo '<br />';
echo '<br />';

if (strcmp($pin_status, '1') == 1) {
	echo '
                <button name="power" class="power_off">Off</button>
             ';
}
else {
	echo '
		<button name="power" class="power_on">On</button>
	     ';
}

if (isset($_GET['on'])) {
	shell_exec('/usr/bin/gpio write 4 0');
	echo '<script>window.location = "./test.php"</script>';
}
elseif (isset($_GET['off'])) {
	shell_exec('/usr/bin/gpio write 4 1');
	echo '<script>window.location = "./test.php"</script>';
}
else {}

?>
