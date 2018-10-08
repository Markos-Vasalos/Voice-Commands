<?php
$language = $_POST['language'];
$voiceCommand = $_POST['voiceCommand'];
$percent=0;
$matchedCommand = 'No match is found';
$shellExecMessages = 'empty';
// Create connection
try
{
    $db = new PDO('mysql:host=127.0.0.1;dbname=Voice_Commands;charset=utf8', 'praktiki', 'test1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e)
{
    echo $e->getMessage();
}

if ($language == "greek")
{
    $query = "select * from valid_el_commands";
}
else
{
    $query = "select * from valid_en_commands";
}
try
{
    $result = $db->prepare($query);
    $result->execute();
}
catch (PDOException $e)
{
    echo $e->getMessage();
}


while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    global $percent, $matchedCommand;
    similar_text($row->command, $voiceCommand, $percent);
    if ($percent >= 85) {
        $matchedCommand = $row->command;
        break;
    }
    $percent = 0;
}
switch ($row->id){
    case (1):
        $shellExecMessages = shell_exec('sudo /python_files/close_the_light.py 2>&1');

        break;
    case (2):
        $shellExecMessages = shell_exec('sudo /python_files/open_the_light.py 2>&1');

        break;
}

$jsonArray = array('command' => $matchedCommand, 'percentage' => $percent, 'shellExecMessages' =>$shellExecMessages);
echo json_encode($jsonArray);

?>
