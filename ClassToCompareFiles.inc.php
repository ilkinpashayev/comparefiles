<?Php
class ClassToCompareFiles
{

	public function uploadFile($file1, $file2)
	{
		echo "<br>upload file ".$file1['tmp_name']."<br>";

		move_uploaded_file($file1['tmp_name'], 'uploads/'.$file1['name']);
		move_uploaded_file($file2['tmp_name'], 'uploads/'.$file2['name']);
	}
    public function compareFiles($file1, $file2)
    {
		//echo $file1;
        set_time_limit(0);
        $asciiList = Array();
        for ($x = 1;$x <= 128;$x++)
        {
            array_push($asciiList, chr($x));
        }
        $firstCompare = Array();
        $secondCompare = Array();
        $firstLine = 0;
        $secondLine = 0;
        $fileArray = Array();
        $fileArray2 = Array();
        $file_handle = fopen($file1, "r");
        while (!feof($file_handle))
        {
            $line = fgets($file_handle);
            array_push($fileArray, $line);
            //echo $line;
            
        }
        fclose($file_handle);

        $file_handle2 = fopen($file2, "r");
        while (!feof($file_handle2))
        {
            $line = fgets($file_handle2);
            array_push($fileArray2, $line);
        }
        fclose($file_handle2);

        $max = count($fileArray);
        if (count($fileArray2) > $max)
        {
            $max = count($fileArray2);
        }
        $condition = true;

        while ($condition)
        {
            if ($firstLine + 1 > count($fileArray) || $secondLine + 1 > count($fileArray2))
            {
                $condition = false;
                if ($firstLine + 1 > count($fileArray))
                {
                    for ($i = 0;$i < count($fileArray2) - $secondLine;$i++)
                    {
                        array_push($secondCompare, $fileArray2[$secondLine + $i]);
                    }
                }
                else
                {
                    for ($i = 0;$i < count($fileArray) - $firstLine;$i++)
                    {
                        array_push($firstCompare, $fileArray[$firstLine + $i]);
                    }
                }
            }
            else
            {
                if (trim($fileArray[$firstLine]) == trim($fileArray2[$secondLine]))
                {
                    $firstLine++;
                    $secondLine++;
                    continue;
                }
                else
                {
                    $asciindex = 0;
                    $jk = 0;
                    $done = false;
                    for ($j = 0;$j < strlen($fileArray[$firstLine]);$j++)
                    {
                        $jk = $j;
                        $firstAsciiIndex1 = array_search($fileArray[$firstLine][$j], $asciiList);
                        if ($j + 1 <= strlen($fileArray2[$secondLine]))
                        {
                            $firstAsciiIndex2 = array_search($fileArray2[$secondLine][$j], $asciiList);
                        }
                        else
                        {
                            array_push($secondCompare, $fileArray2[$secondLine]);

                            $secondLine++;
                            $done = true;
                            break;
                        }
                        if ($firstAsciiIndex1 == $firstAsciiIndex2)
                        {
                            continue;
                        }
                        else
                        {
                            if ($firstAsciiIndex1 < $firstAsciiIndex2)
                            {
                                array_push($firstCompare, $fileArray[$firstLine]);
                                $firstLine++;
                                $done = true;
                                break;
                            }
                            else
                            {
                                array_push($secondCompare, $fileArray2[$secondLine]);
                                $secondLine++;
                                $done = true;
                                break;
                            }
                        }
                    }
                    if (!$done)
                    {
                        array_push($firstCompare, $fileArray[$firstLine]);
                        $firstLine++;
                    }
                }
            }
        }

        $input = "";
        foreach ($firstCompare as $linelement)
        {
            $input .= $linelement;
        }
        file_put_contents('comaprefile1.txt', $input);

        $input = "";
        foreach ($secondCompare as $linelement)
        {
            $input .= $linelement;
        }
        file_put_contents('comaprefile2.txt', $input);
    }

}
?>
