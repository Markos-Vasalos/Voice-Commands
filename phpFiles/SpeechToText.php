<?php
	class SpeechToText
	{
		
		function convert($file,$rate,$lang)
		{
			define("googleSpeechUrl","https://www.google.com/speech-api/v2/recognize");
			define("key","key="); //insert your API key here
			define("parameters","output=json");
			define("grLanguageParam","lang=el-gr");
			define("enLanguageParam","lang=en-us");
			
			if (!(empty ($file)))//empty returns bool
			{
				if (!(empty ($lang)))
				{
					if (empty ($rate))
					{
						echo ("error, sampleRate not specified. pass the filepath as first argument in convert, and sample rate as second");

					
					}
					else
					{
						if ($lang == "english")
						{
							$conversionUrl = googleSpeechUrl."?".parameters."&".enLanguageParam."&".key;
						}
						else 
						{
                            $conversionUrl = googleSpeechUrl."?".parameters."&".grLanguageParam."&".key;
						}
						$filePath = $file;
						$sampleRate = trim($rate);
						$args['file'] = new CurlFile ($filePath);
						$ch = curl_init($conversionUrl);
						curl_setopt($ch, CURLOPT_POST, true); //-X
						curl_setopt($ch, CURLOPT_POSTFIELDS,$args); //contains the voice_file and declares a post
						curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE); // --data-binary IS necessary if u want to pass the result as a string and not to just 		 			display it*
						//*but from php 5.1.3 and after the raw output will always be displayed
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //in order to pass the result to curl_exec() rather than output (echo) the result.
						curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: audio/l16; rate='.$sampleRate.';')); // --header
						//reference on the above on http://stackoverflow.com/questions/1939609/convert-command-line-curl-to-php-curl
						//and on https://wiki.php.net/rfc/curl-file-upload
						//and on http://php.net/manual/en/function.curl-setopt.php
						$result = curl_exec($ch);
						if ($result) // execute curl post
						{
							curl_close($ch); // close connection
							//echo "success";
							return $result;
						}
						else
						{
							return "error with curl_exec";
						}
					}
				}
			}
			else 
			{
				echo ("error, filepath not specified. pass the filepath as first argument in convert, and sample rate as second");
			}
		}
	}
?>
