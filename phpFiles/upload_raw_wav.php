<?php
	if ($_FILES['rec']['error'] > 0 )
	{
		echo 'Problem: ';
		switch ($_FILES['rec']['error'])
		{
			case 1: echo 'File exceeded upload_max_filesize';
				break;
			case 2: echo 'File exceeded max_file_size';
				break;
			case 3: echo 'File only partially uploaded'; 
				break;
			case 4: echo 'No file uploaded';
				break;
			case 6: echo 'Cannot upload file: No temp directory specified';
				break;
			case 7: echo 'Upload failed: Cannot write to disk';
				break;
		}
		exit;
	}
	if (is_uploaded_file ($_FILES['rec']['tmp_name']))
	{
		if (isset ($_POST['rate']))
		{
			include 'SpeechToText.php';
			$sttx = new SpeechToText();
			//this gives us the full path to the file we uploaded.
			$filePath = $_FILES['rec']['tmp_name'];
			$sampleRate = $_POST['rate'];
			$language = $_POST['language'];
			$result = $sttx->convert($filePath,$sampleRate,$language);
			echo $result; 
			
		}			
	}
	else
	{
		echo "problem with upload";
	}
?>
