<?php
$module = 'win_serial';
 
if (extension_loaded($module)) {
     $str = "Module loaded";
} 
else 
{
     $str = "Module $module is not compiled into PHP";
     die("Module $module is not compiled into PHP");
}

echo "$str<br>";
 
$functions = get_extension_funcs($module);
echo "Functions available in the $module extension:<br>\n";
foreach($functions as $func) {
    echo $func."<br>";
}
echo "<br>";

echo "Version ".ser_version();
echo "<br>";
echo "<br>";



echo "test rfid card";echo "<br>";

$str="\x02\x04\xA0\x59\x57\xAA\x03";

//echo $str;echo "<br>";

ser_open( "COM1", 19200, 8, "None", "1", "None" );

if (ser_isopen())
   echo "Port is open!.";
echo "<br>";
ser_write("$str");

sleep(1);

$str = ser_read();
$str=bin2hex($str);
echo "Received1: $str";
echo "<br>";

$str="\x02\x10\x02\xA1\xA3\x03";
ser_write("$str");

sleep(1);
for($i=1;$i<=10;$i++)
{
$b = ser_readbyte();
$b=dechex($b);
if (strlen($b)<2)
   echo "0".$b;
else
   echo substr($b,-2);
echo "&nbsp";

 }   
echo "<br>";
ser_close();

?>
