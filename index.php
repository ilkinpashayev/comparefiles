<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<center> 
	<font face="verdana" size="4" color="green" >Upload files.</font>
</center>
<br/>
<?php
 
if( isset($_FILES['firstFile']['name']) && strlen($_FILES['firstFile']['name'])>0  && isset($_FILES['fileToCompare']['name']) && strlen($_FILES['fileToCompare']['name'])>0) 
{
	require_once('ClassToCompareFiles.inc.php');
	$compareFiles = new ClassToCompareFiles;
	$file1 = $_FILES['firstFile'];
	$file2 = $_FILES['fileToCompare'];


	$compareFiles->uploadFile($file1, $file2);
	$compareFiles->compareFiles('uploads/'.$file1['name'], 'uploads/'.$file2['name']);

}
?>
 <form action = "<?php $_PHP_SELF ?>" method = "POST" enctype="multipart/form-data">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: medium solid #000000;border-right: medium solid #000000;border-left: medium solid #000000;border-bottom: medium solid #000000">
		<tr >
			<td width="50%" align="center" bgcolor="#ccddff">
				<font face="verdana" size="3" ><b>Select the main file: </b></font>
				<input type="file" name="firstFile"/>
			</td>
			<td width="50%" align="center" bgcolor="#ffccdd">
				<font face="verdana" size="3" ><B>Select the file to be compared: </b></font>
				<input type="file" name="fileToCompare"/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br/>
					<input type="submit" />
				<br/>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<br />
			</td>
		</tr>
	</table>
</form>


</body>
</html>
